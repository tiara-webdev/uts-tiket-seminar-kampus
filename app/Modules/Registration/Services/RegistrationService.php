<?php

namespace App\Modules\Registration\Services;

use App\Models\User;
use App\Modules\Event\Contracts\EventInfoContract;
use App\Modules\Registration\Exceptions\EventNotAvailableException;
use App\Modules\Registration\Exceptions\InvalidRegistrationStatusException;
use App\Modules\Registration\Exceptions\InvalidTicketCodeException;
use App\Modules\Registration\Models\Registration;
use App\Modules\Ticket\Contracts\TicketStockContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegistrationService
{
    // Komunikasi dengan modul lain hanya lewat Contract, bukan model
    public function __construct(
        private TicketStockContract $stock,
        private EventInfoContract $events,
    ) {}

    /** Peserta memesan tiket: kuota dikurangi, status pending, data harga disimpan sebagai snapshot. */
    public function order(User $user, int $ticketTypeId, int $quantity): Registration
    {
        return DB::transaction(function () use ($user, $ticketTypeId, $quantity) {
            // Melempar TicketQuotaExceededException jika kuota tidak cukup
            $ticket = $this->stock->reserve($ticketTypeId, $quantity);

            $event = $this->events->find($ticket['event_id']);

            // Exception di dalam transaction membatalkan pengurangan kuota (rollback)
            if (! $event || $event['status'] !== 'published') {
                throw new EventNotAvailableException();
            }

            return Registration::create([
                'user_id' => $user->id,
                'event_id' => $ticket['event_id'],
                'ticket_type_id' => $ticket['ticket_type_id'],
                'event_title' => $event['title'],
                'ticket_type_name' => $ticket['name'],
                'unit_price' => $ticket['price'],
                'quantity' => $quantity,
                'total_price' => $ticket['price'] * $quantity,
                'status' => Registration::STATUS_PENDING,
            ]);
        });
    }

    /** Admin mengonfirmasi pembayaran: status confirmed dan kode tiket unik dibuat. */
    public function confirm(Registration $registration): Registration
    {
        return DB::transaction(function () use ($registration) {
            $registration = Registration::query()->lockForUpdate()->findOrFail($registration->id);

            if ($registration->status !== Registration::STATUS_PENDING) {
                throw new InvalidRegistrationStatusException(
                    'Hanya pesanan berstatus pending yang bisa dikonfirmasi.'
                );
            }

            $registration->update([
                'status' => Registration::STATUS_CONFIRMED,
                'ticket_code' => $this->generateUniqueCode(),
                'confirmed_at' => now(),
            ]);

            return $registration;
        });
    }

    /** Pesanan dibatalkan peserta atau ditolak admin: kuota dikembalikan. */
    public function cancel(Registration $registration): Registration
    {
        return DB::transaction(function () use ($registration) {
            $registration = Registration::query()->lockForUpdate()->findOrFail($registration->id);

            if ($registration->status !== Registration::STATUS_PENDING) {
                throw new InvalidRegistrationStatusException(
                    'Hanya pesanan berstatus pending yang bisa dibatalkan.'
                );
            }

            $this->stock->release($registration->ticket_type_id, $registration->quantity);

            $registration->update(['status' => Registration::STATUS_CANCELLED]);

            return $registration;
        });
    }

    /** Admin check-in peserta lewat kode tiket. */
    public function checkIn(string $ticketCode): Registration
    {
        return DB::transaction(function () use ($ticketCode) {
            $registration = Registration::query()
                ->lockForUpdate()
                ->where('ticket_code', $ticketCode)
                ->first();

            if (! $registration) {
                throw new InvalidTicketCodeException();
            }

            if ($registration->status !== Registration::STATUS_CONFIRMED) {
                throw new InvalidRegistrationStatusException(
                    'Tiket ini tidak bisa dipakai check-in (sudah check-in atau dibatalkan).'
                );
            }

            $registration->update([
                'status' => Registration::STATUS_CHECKED_IN,
                'checked_in_at' => now(),
            ]);

            return $registration;
        });
    }

    private function generateUniqueCode(): string
    {
        do {
            $code = 'SEM-' . strtoupper(Str::random(8));
        } while (Registration::where('ticket_code', $code)->exists());

        return $code;
    }
}

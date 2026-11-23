<?php

namespace App\Modules\Ticket\Services;

use App\Modules\Ticket\Contracts\TicketStockContract;
use App\Modules\Ticket\Exceptions\TicketQuotaExceededException;
use App\Modules\Ticket\Models\TicketType;

class TicketStockService implements TicketStockContract
{
    public function reserve(int $ticketTypeId, int $qty): array
    {
        // lockForUpdate efektif saat dipanggil di dalam DB::transaction (dilakukan RegistrationService)
        $ticketType = TicketType::query()->lockForUpdate()->findOrFail($ticketTypeId);

        if ($qty > $ticketType->remaining()) {
            throw new TicketQuotaExceededException($ticketType->remaining());
        }

        $ticketType->increment('reserved', $qty);

        return [
            'ticket_type_id' => $ticketType->id,
            'event_id' => $ticketType->event_id,
            'name' => $ticketType->name,
            'price' => $ticketType->price,
        ];
    }

    public function release(int $ticketTypeId, int $qty): void
    {
        $ticketType = TicketType::query()->lockForUpdate()->findOrFail($ticketTypeId);

        $ticketType->update([
            'reserved' => max(0, $ticketType->reserved - $qty),
        ]);
    }
}

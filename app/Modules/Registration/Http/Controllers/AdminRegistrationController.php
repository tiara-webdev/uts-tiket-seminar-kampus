<?php

namespace App\Modules\Registration\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Registration\Exceptions\InvalidRegistrationStatusException;
use App\Modules\Registration\Exceptions\InvalidTicketCodeException;
use App\Modules\Registration\Http\Requests\CheckInRequest;
use App\Modules\Registration\Models\Registration;
use App\Modules\Registration\Services\RegistrationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminRegistrationController extends Controller
{
    private const STATUSES = ['pending', 'confirmed', 'cancelled', 'checked_in'];

    public function __construct(private RegistrationService $service) {}

    public function index(Request $request)
    {
        $status = in_array($request->query('status'), self::STATUSES, true)
            ? $request->query('status')
            : null;

        $registrations = Registration::with('user')
            ->when($status, fn($query) => $query->where('status', $status))
            ->latest()
            ->get();

        return view('registration::admin.registrations', compact('registrations', 'status'));
    }

    public function confirm(Registration $registration): RedirectResponse
    {
        try {
            $this->service->confirm($registration);
        } catch (InvalidRegistrationStatusException $e) {
            return back()->withErrors(['status' => $e->getMessage()]);
        }

        return back()->with('status', 'Pesanan dikonfirmasi dan kode tiket sudah dibuat.');
    }

    public function reject(Registration $registration): RedirectResponse
    {
        try {
            $this->service->cancel($registration);
        } catch (InvalidRegistrationStatusException $e) {
            return back()->withErrors(['status' => $e->getMessage()]);
        }

        return back()->with('status', 'Pesanan ditolak dan kuota dikembalikan.');
    }

    public function showCheckIn()
    {
        return view('registration::admin.check-in');
    }

    public function checkIn(CheckInRequest $request): RedirectResponse
    {
        try {
            $registration = $this->service->checkIn($request->validated('ticket_code'));
        } catch (InvalidTicketCodeException | InvalidRegistrationStatusException $e) {
            return back()->withErrors(['ticket_code' => $e->getMessage()])->withInput();
        }

        return back()->with(
            'status',
            "Check-in berhasil: {$registration->event_title} ({$registration->ticket_code})."
        );
    }
}

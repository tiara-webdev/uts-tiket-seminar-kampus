<?php

namespace App\Modules\Registration\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Registration\Exceptions\EventNotAvailableException;
use App\Modules\Registration\Exceptions\InvalidRegistrationStatusException;
use App\Modules\Registration\Http\Requests\OrderRequest;
use App\Modules\Registration\Models\Registration;
use App\Modules\Registration\Services\RegistrationService;
use App\Modules\Ticket\Exceptions\TicketQuotaExceededException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function __construct(private RegistrationService $service) {}

    public function index(Request $request)
    {
        $registrations = Registration::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return view('registration::registrations.index', compact('registrations'));
    }

    public function store(OrderRequest $request): RedirectResponse
    {
        try {
            $this->service->order(
                $request->user(),
                $request->validated('ticket_type_id'),
                $request->validated('quantity'),
            );
        } catch (TicketQuotaExceededException | EventNotAvailableException $e) {
            return back()->withErrors(['quantity' => $e->getMessage()])->withInput();
        }

        return redirect()->route('my-tickets')
            ->with('status', 'Pesanan berhasil dibuat. Menunggu konfirmasi admin.');
    }

    public function cancel(Request $request, Registration $registration): RedirectResponse
    {
        abort_unless($registration->user_id === $request->user()->id, 403);

        try {
            $this->service->cancel($registration);
        } catch (InvalidRegistrationStatusException $e) {
            return back()->withErrors(['status' => $e->getMessage()]);
        }

        return back()->with('status', 'Pesanan berhasil dibatalkan.');
    }
}

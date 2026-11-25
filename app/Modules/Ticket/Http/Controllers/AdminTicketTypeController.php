<?php

namespace App\Modules\Ticket\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Contracts\EventInfoContract;
use App\Modules\Ticket\Http\Requests\TicketTypeRequest;
use App\Modules\Ticket\Models\TicketType;
use Illuminate\Http\RedirectResponse;

class AdminTicketTypeController extends Controller
{
    // Data event diambil lewat Contract, bukan model Event
    public function __construct(private EventInfoContract $events) {}

    public function index(int $eventId)
    {
        $event = $this->events->find($eventId);
        abort_if($event === null, 404);

        $ticketTypes = TicketType::where('event_id', $eventId)->orderBy('price')->get();

        return view('ticket::admin.tickets', compact('event', 'ticketTypes'));
    }

    public function store(TicketTypeRequest $request, int $eventId): RedirectResponse
    {
        abort_if($this->events->find($eventId) === null, 404);

        TicketType::create([
            'event_id' => $eventId,
            'name' => $request->validated('name'),
            'price' => $request->validated('price'),
            'quota' => $request->validated('quota'),
            'reserved' => 0,
        ]);

        return back()->with('status', 'Jenis tiket berhasil ditambahkan.');
    }

    public function destroy(TicketType $ticketType): RedirectResponse
    {
        if ($ticketType->reserved > 0) {
            return back()->withErrors(['ticket' => 'Jenis tiket sudah dipesan, tidak bisa dihapus.']);
        }

        $ticketType->delete();

        return back()->with('status', 'Jenis tiket berhasil dihapus.');
    }
}

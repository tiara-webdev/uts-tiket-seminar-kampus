<?php

namespace App\Modules\Event\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Models\Event;
use App\Modules\Ticket\Contracts\TicketCatalogContract;

class EventController extends Controller
{
    public function __construct(private TicketCatalogContract $tickets) {}

    public function index()
    {
        $events = Event::with('category')
            ->where('status', 'published')
            ->orderBy('event_date')
            ->get();

        return view('event::events.index', compact('events'));
    }

    public function show(Event $event)
    {
        abort_unless($event->status === 'published', 404);

        $event->load(['category', 'speakers']);
        $ticketTypes = $this->tickets->forEvent($event->id);

        return view('event::events.show', compact('event', 'ticketTypes'));
    }
}

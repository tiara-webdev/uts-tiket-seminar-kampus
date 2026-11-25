<?php

namespace App\Modules\Event\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('category')->orderByDesc('event_date')->get();

        return view('event::admin.events.index', compact('events'));
    }
}

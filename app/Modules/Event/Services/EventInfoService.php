<?php

namespace App\Modules\Event\Services;

use App\Modules\Event\Contracts\EventInfoContract;
use App\Modules\Event\Models\Event;

class EventInfoService implements EventInfoContract
{
    public function find(int $eventId): ?array
    {
        $event = Event::find($eventId);

        if (! $event) {
            return null;
        }

        return [
            'id' => $event->id,
            'title' => $event->title,
            'event_date' => $event->event_date,
            'status' => $event->status,
        ];
    }
}

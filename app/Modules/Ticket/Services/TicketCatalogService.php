<?php

namespace App\Modules\Ticket\Services;

use App\Modules\Ticket\Contracts\TicketCatalogContract;
use App\Modules\Ticket\Models\TicketType;

class TicketCatalogService implements TicketCatalogContract
{
    public function forEvent(int $eventId): array
    {
        return TicketType::query()
            ->where('event_id', $eventId)
            ->orderBy('price')
            ->get()
            ->map(fn(TicketType $t) => [
                'id' => $t->id,
                'name' => $t->name,
                'price' => $t->price,
                'remaining' => $t->remaining(),
            ])
            ->all();
    }
}

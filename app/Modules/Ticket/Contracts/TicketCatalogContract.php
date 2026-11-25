<?php

namespace App\Modules\Ticket\Contracts;

interface TicketCatalogContract
{
    /** Daftar jenis tiket sebuah event. Tiap item: id, name, price, remaining. */
    public function forEvent(int $eventId): array;
}

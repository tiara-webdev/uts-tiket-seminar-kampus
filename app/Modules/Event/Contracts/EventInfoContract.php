<?php

namespace App\Modules\Event\Contracts;

interface EventInfoContract
{
    /**
     * Mengembalikan data ringkas event (id, title, event_date, status),
     * atau null jika event tidak ditemukan.
     */
    public function find(int $eventId): ?array;
}

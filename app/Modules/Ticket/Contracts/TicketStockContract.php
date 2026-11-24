<?php

namespace App\Modules\Ticket\Contracts;

interface TicketStockContract
{
    /**
     * Kurangi kuota tiket. Melempar TicketQuotaExceededException jika kuota tidak cukup.
     * Mengembalikan data snapshot: ticket_type_id, event_id, name, price.
     */
    public function reserve(int $ticketTypeId, int $qty): array;

    /** Kembalikan kuota (pesanan dibatalkan atau ditolak). */
    public function release(int $ticketTypeId, int $qty): void;
}

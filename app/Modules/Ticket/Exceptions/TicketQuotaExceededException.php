<?php

namespace App\Modules\Ticket\Exceptions;

use Exception;

class TicketQuotaExceededException extends Exception
{
    public function __construct(public readonly int $available)
    {
        parent::__construct("Kuota tiket tidak cukup. Sisa tiket: {$available}.");
    }
}

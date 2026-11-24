<?php

namespace App\Modules\Registration\Exceptions;

use Exception;

class EventNotAvailableException extends Exception
{
    public function __construct()
    {
        parent::__construct('Event tidak tersedia atau belum dipublikasikan.');
    }
}

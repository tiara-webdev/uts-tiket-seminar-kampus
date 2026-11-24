<?php

namespace App\Modules\Registration\Exceptions;

use Exception;

class InvalidTicketCodeException extends Exception
{
    public function __construct()
    {
        parent::__construct('Kode tiket tidak ditemukan.');
    }
}

<?php

namespace App\Modules\Ticket\Models;

use App\Modules\Ticket\Database\Factories\TicketTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'price',
        'quota',
        'reserved',
    ];

    protected static function newFactory(): TicketTypeFactory
    {
        return TicketTypeFactory::new();
    }

    // Sisa kuota tiket yang masih bisa dipesan
    public function remaining(): int
    {
        return $this->quota - $this->reserved;
    }
}

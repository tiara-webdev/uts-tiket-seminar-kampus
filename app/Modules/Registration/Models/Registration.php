<?php

namespace App\Modules\Registration\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_CHECKED_IN = 'checked_in';

    protected $fillable = [
        'user_id',
        'event_id',
        'ticket_type_id',
        'event_title',
        'ticket_type_name',
        'unit_price',
        'quantity',
        'total_price',
        'status',
        'ticket_code',
        'confirmed_at',
        'checked_in_at',
    ];

    protected function casts(): array
    {
        return [
            'confirmed_at' => 'datetime',
            'checked_in_at' => 'datetime',
        ];
    }

    // One-to-Many: satu user punya banyak pendaftaran
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Modules\Event\Models;

use App\Modules\Event\Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'location',
        'event_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'datetime',
        ];
    }

    protected static function newFactory(): EventFactory
    {
        return EventFactory::new();
    }

    // Kebalikan One-to-Many: event milik satu kategori
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Many-to-Many: event punya banyak pembicara lewat pivot event_speaker
    public function speakers(): BelongsToMany
    {
        return $this->belongsToMany(Speaker::class, 'event_speaker')
            ->withPivot('role')
            ->withTimestamps();
    }
}

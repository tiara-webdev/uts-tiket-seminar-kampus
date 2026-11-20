<?php

namespace App\Modules\Event\Models;

use App\Modules\Event\Database\Factories\SpeakerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Speaker extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'bio'];

    protected static function newFactory(): SpeakerFactory
    {
        return SpeakerFactory::new();
    }

    // Many-to-Many: satu pembicara bisa mengisi banyak event
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_speaker')
            ->withPivot('role')
            ->withTimestamps();
    }
}

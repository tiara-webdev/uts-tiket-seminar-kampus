<?php

namespace App\Modules\Event\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Speaker extends Model
{
    protected $fillable = ['name', 'bio'];

    // Many-to-Many: satu pembicara bisa mengisi banyak event
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_speaker')
            ->withPivot('role')
            ->withTimestamps();
    }
}

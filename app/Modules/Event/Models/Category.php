<?php

namespace App\Modules\Event\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    // One-to-Many: satu kategori punya banyak event
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}

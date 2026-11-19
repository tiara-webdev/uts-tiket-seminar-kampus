<?php

namespace App\Modules\Event\Models;

use App\Modules\Event\Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }

    // One-to-Many: satu kategori punya banyak event
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}

<?php

namespace App\Modules\Event\Database\Factories;

use App\Modules\Event\Models\Speaker;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpeakerFactory extends Factory
{
    protected $model = Speaker::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'bio' => fake()->sentence(12),
        ];
    }
}

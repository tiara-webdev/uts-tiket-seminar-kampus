<?php

namespace App\Modules\Event\Database\Factories;

use App\Modules\Event\Models\Category;
use App\Modules\Event\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'title' => 'Seminar ' . fake()->words(3, true),
            'description' => fake()->paragraph(),
            'location' => fake()->randomElement(['Aula Utama', 'Ruang Seminar A', 'Lab Komputer 1', 'Auditorium Kampus']),
            'event_date' => fake()->dateTimeBetween('+1 week', '+3 months'),
            'status' => fake()->randomElement(['draft', 'published']),
        ];
    }
}

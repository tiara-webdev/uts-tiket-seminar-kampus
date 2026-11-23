<?php

namespace App\Modules\Ticket\Database\Factories;

use App\Modules\Ticket\Models\TicketType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketTypeFactory extends Factory
{
    protected $model = TicketType::class;

    public function definition(): array
    {
        return [
            'event_id' => 1,
            'name' => fake()->randomElement(['Mahasiswa', 'Umum', 'VIP']),
            'price' => fake()->randomElement([0, 25000, 50000, 75000]),
            'quota' => fake()->numberBetween(30, 150),
            'reserved' => 0,
        ];
    }
}

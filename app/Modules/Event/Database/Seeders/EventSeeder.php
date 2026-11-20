<?php

namespace App\Modules\Event\Database\Seeders;

use App\Modules\Event\Models\Category;
use App\Modules\Event\Models\Event;
use App\Modules\Event\Models\Speaker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        // Kategori tetap
        $categories = collect(['Seminar', 'Workshop', 'Pelatihan'])->map(
            fn(string $name) => Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            )
        );

        $speakers = Speaker::factory()->count(8)->create();

        // 10 event, tiap event punya 1 sampai 3 pembicara (pivot dengan kolom role)
        Event::factory()
            ->count(10)
            ->state(fn() => ['category_id' => $categories->random()->id])
            ->create()
            ->each(function (Event $event) use ($speakers) {
                $attach = [];
                foreach ($speakers->random(rand(1, 3)) as $speaker) {
                    $attach[$speaker->id] = [
                        'role' => fake()->randomElement(['Keynote', 'Pemateri', 'Moderator']),
                    ];
                }
                $event->speakers()->attach($attach);
            });
    }
}

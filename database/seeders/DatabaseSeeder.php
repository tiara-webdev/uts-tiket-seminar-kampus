<?php

namespace Database\Seeders;

use App\Modules\Event\Database\Seeders\EventSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            EventSeeder::class,
        ]);
    }
}

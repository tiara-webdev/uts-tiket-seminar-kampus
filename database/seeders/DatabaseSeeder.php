<?php

namespace Database\Seeders;

use App\Modules\Event\Database\Seeders\EventSeeder;
use App\Modules\Ticket\Database\Seeders\TicketSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            EventSeeder::class,
            TicketSeeder::class,
        ]);
    }
}

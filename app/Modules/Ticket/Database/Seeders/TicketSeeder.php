<?php

namespace App\Modules\Ticket\Database\Seeders;

use App\Modules\Ticket\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        // Event dibuat oleh EventSeeder dengan id 1 sampai 10.
        // Di sini hanya memakai angka id (bukan model Event) supaya batas modul tetap terjaga.
        for ($eventId = 1; $eventId <= 10; $eventId++) {
            TicketType::factory()->create([
                'event_id' => $eventId,
                'name' => 'Mahasiswa',
                'price' => 25000,
            ]);

            TicketType::factory()->create([
                'event_id' => $eventId,
                'name' => 'Umum',
                'price' => 50000,
            ]);
        }
    }
}

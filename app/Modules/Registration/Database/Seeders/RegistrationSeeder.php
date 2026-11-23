<?php

namespace App\Modules\Registration\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::firstOrCreate(
            ['email' => 'admin@kampus.test'],
            [
                'name' => 'Admin Kampus',
                'password' => 'password',
                'role' => 'admin',
            ]
        );

        // Akun Peserta
        User::firstOrCreate(
            ['email' => 'peserta@kampus.test'],
            [
                'name' => 'Peserta Contoh',
                'password' => 'password',
                'role' => 'participant',
            ]
        );

        // Beberapa peserta tambahan
        User::factory()->count(3)->create(['role' => 'participant']);
    }
}

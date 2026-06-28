<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'admin@sadasosial.org',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@sadasosial.org',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Ahmad Hidayat',
            'email' => 'ahmad@sadasosial.org',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Dewi Lestari',
            'email' => 'dewi@sadasosial.org',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Rian Wijaya',
            'email' => 'rian@sadasosial.org',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);
    }
}

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
            'validation_status' => 'validated',
        ]);

        User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@sadasosial.org',
            'password' => bcrypt('password'),
            'role' => 'user',
            'validation_status' => 'validated',
        ]);

        User::create([
            'name' => 'Ahmad Hidayat',
            'email' => 'ahmad@sadasosial.org',
            'password' => bcrypt('password'),
            'role' => 'user',
            'validation_status' => 'validated',
        ]);

        User::create([
            'name' => 'Dewi Lestari',
            'email' => 'dewi@sadasosial.org',
            'password' => bcrypt('password'),
            'role' => 'user',
            'validation_status' => 'validated',
        ]);

        User::create([
            'name' => 'Rian Wijaya',
            'email' => 'rian@sadasosial.org',
            'password' => bcrypt('password'),
            'role' => 'user',
            'validation_status' => 'validated',
        ]);

        // Dedicated Role Testing Accounts
        User::create([
            'name' => 'Operator Sekretariat',
            'email' => 'sekretariat@sadasosial.org',
            'password' => bcrypt('password'),
            'role' => 'sekretariat',
            'validation_status' => 'validated',
        ]);

        User::create([
            'name' => 'Verifikator Administrasi',
            'email' => 'verifikator@sadasosial.org',
            'password' => bcrypt('password'),
            'role' => 'verifikator',
            'validation_status' => 'validated',
        ]);

        User::create([
            'name' => 'Dinsos Kab/Kota',
            'email' => 'wilayah@sadasosial.org',
            'password' => bcrypt('password'),
            'role' => 'dinsos_wilayah',
            'validation_status' => 'validated',
        ]);

        User::create([
            'name' => 'Bidang Pemberdayaan',
            'email' => 'pemberdayaan@sadasosial.org',
            'password' => bcrypt('password'),
            'role' => 'bidang_pemberdayaan',
            'validation_status' => 'validated',
        ]);

        User::create([
            'name' => 'Bidang Linjamsos',
            'email' => 'linjamsos@sadasosial.org',
            'password' => bcrypt('password'),
            'role' => 'bidang_linjamsos',
            'validation_status' => 'validated',
        ]);

        User::create([
            'name' => 'Kepala Dinas',
            'email' => 'kadinas@sadasosial.org',
            'password' => bcrypt('password'),
            'role' => 'kadinas',
            'validation_status' => 'validated',
        ]);

        User::create([
            'name' => 'Pemohon Testing',
            'email' => 'pemohon@sadasosial.org',
            'password' => bcrypt('password'),
            'role' => 'user',
            'validation_status' => 'validated',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(PerizinanSeeder::class);
    }
}

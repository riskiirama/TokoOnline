<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Jalankan semua seeder utama aplikasi.
     */
    public function run(): void
    {
        // Jalankan seeder untuk role dan user admin
        $this->call([
            AdminUserSeeder::class,
            CustomerUserSeeder::class,
        ]);
    }
}

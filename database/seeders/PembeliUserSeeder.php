<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class PembeliUserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat role "pembeli" jika belum ada
        $pembeliRole = Role::firstOrCreate(['name' => 'pembeli']);

        // Buat user pembeli
        $user = User::firstOrCreate(
            ['email' => 'pembeli@gmail.com'],
            [
                'name' => 'Pembeli',
                'password' => bcrypt('123'), // password = 123
            ]
        );

        // Berikan role pembeli ke user
        $user->assignRole($pembeliRole);
    }
}

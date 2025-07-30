<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CustomerUserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat role "pembeli" jika belum ada
        $customerRole = Role::firstOrCreate(['name' => 'customer']);

        // Buat user pembeli
        $user = User::firstOrCreate(
            ['email' => 'pembeli@gmail.com'],
            [
                'name' => 'customer',
                'password' => bcrypt('123'), // password = 123
            ]
        );

        // Berikan role pembeli ke user
        $user->assignRole($customerRole);
    }
}

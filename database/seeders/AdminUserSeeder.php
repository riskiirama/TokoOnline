<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123'),
                'role' => 'admin', // langsung isi kolom role
            ]
        );

        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Assign role Spatie
        $user->assignRole($adminRole);

        // Pastikan kolom 'role' tetap diisi walau user sudah ada
        if ($user->role !== 'admin') {
            $user->update(['role' => 'admin']);
        }
    }
}

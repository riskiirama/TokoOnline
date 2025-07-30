<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Buat role jika belum ada
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $customerRole = Role::firstOrCreate(['name' => 'customer']);

        // Beri role ke user pertama (ID = 1), misalnya sebagai admin
        $user = User::find(1);
        if ($user && !$user->hasRole('admin')) {
            $user->assignRole($adminRole);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat role
        $roles = ['admin', 'technician', 'user'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Buat akun admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('admin');

        // Buat akun teknisi
        $tech = User::firstOrCreate(
            ['email' => 'tech@example.com'],
            [
                'name' => 'Technician One',
                'password' => Hash::make('password'),
            ]
        );
        $tech->assignRole('technician');

        // Buat akun user/client
        $client = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Client User',
                'password' => Hash::make('password'),
            ]
        );
        $client->assignRole('user');
    }
}

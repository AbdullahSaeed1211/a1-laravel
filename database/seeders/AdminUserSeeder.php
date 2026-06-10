<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@a1traininggroupllc.com'],
            [
                'name' => 'A1 Admin',
                'email' => 'admin@a1traininggroupllc.com',
                'password' => Hash::make(env('ADMIN_INITIAL_PASSWORD', 'A1Training2024!')),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'mirchwebdev@gmail.com'],
            [
                'name' => 'Mirch Web Dev',
                'email' => 'mirchwebdev@gmail.com',
                'password' => Hash::make(env('ADMIN_INITIAL_PASSWORD', 'A1Training2024!')),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}

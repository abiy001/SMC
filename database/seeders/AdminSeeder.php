<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@smc.ac.id'],
            [
                'id'       => Str::uuid(),
                'name'     => 'Super Admin',
                'password' => Hash::make('password123'),
                'role'     => UserRole::Admin->value,
            ]
        );
    }
}
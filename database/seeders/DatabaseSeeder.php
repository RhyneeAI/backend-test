<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Hash;
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
        User::create([
            'email' => 'udinnganga@gmail.com',
            'password' => Hash::make('udinnganga123'),
            'role' => Role::ADMIN
        ]);
    }
}

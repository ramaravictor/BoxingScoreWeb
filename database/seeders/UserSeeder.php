<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data Juri
        User::create([
            'name' => 'Juri A',
            'email' => 'juri@example.com',
            'password' => Hash::make('password'),
            'is_dewanjuri' => false, // Role sebagai Juri
        ]);
        User::create([
            'name' => 'Juri B',
            'email' => 'jurib@example.com',
            'password' => Hash::make('password'),
            'is_dewanjuri' => false, // Role sebagai Juri
        ]);
        User::create([
            'name' => 'Juri C',
            'email' => 'juric@example.com',
            'password' => Hash::make('password'),
            'is_dewanjuri' => false, // Role sebagai Juri
        ]);

        // Data Dewan Juri
        User::create([
            'name' => 'Dewan Juri',
            'email' => 'dewanjuri@example.com',
            'password' => Hash::make('password'),
            'is_dewanjuri' => true, // Role sebagai Dewan Juri
        ]);
    }
}

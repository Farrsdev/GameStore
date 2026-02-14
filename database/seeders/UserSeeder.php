<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Shirley',
            'email' => 's@gmail.com',
            'password' => Hash::make('123456'),
            'isAdmin' => true
        ]);

        User::create([
            'name' => 'FarrAdmin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'isAdmin' => true
        ]);
    }
}

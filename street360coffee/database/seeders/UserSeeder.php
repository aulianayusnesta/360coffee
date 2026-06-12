<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin Street 360',
            'email'    => 'anesta123@gmail.com',
            'username' => 'anesta123',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Kasir Street 360',
            'email'    => 'kasir@street360.com',
            'username' => 'kasir360',
            'password' => Hash::make('kasir123'),
            'role'     => 'kasir',
        ]);
    }
}
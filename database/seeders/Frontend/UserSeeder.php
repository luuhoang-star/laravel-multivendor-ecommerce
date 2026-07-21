<?php

namespace Database\Seeders\Frontend;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        User::create([
            'name' => 'Vendor',
            'email' => 'vendor@gmail.com',
            'password' => bcrypt('12345678'),
            'user_type' => 'vendor',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]);
        }
        if (!User::where('email', 'dosen@example.com')->exists()) {
            User::create([
                'name' => 'Dosen User',
                'email' => 'dosen@example.com',
                'password' => bcrypt('password'),
                'role' => 'dosen',
            ]);
        }
        if (!User::where('email', 'staff@example.com')->exists()) {
            User::create([
                'name' => 'Staff User',
                'email' => 'staff@example.com',
                'password' => bcrypt('password'),
                'role' => 'staff',
            ]);
        }
        if (!User::where('email', 'mahasiswa@example.com')->exists()) {
            User::create([
                'name' => 'Mahasiswa User',
                'email' => 'mahasiswa@example.com',
                'password' => bcrypt('password'),
                'role' => 'mahasiswa',
            ]);
        }
    }
}

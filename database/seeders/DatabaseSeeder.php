<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'IT & Jaringan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kebersihan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fasilitas Kelas', 'created_at' => now(), 'updated_at' => now()],
        ]);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'is_admin' => true
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'is_admin' => false
        ]);
    }
}

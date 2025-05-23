<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;  // Menggunakan Hash untuk bcrypt

class AdminBosSeeder extends Seeder
{
    public function run()
    {
        // Membuat admin
        User::create([
            'name' => 'Admin',
            'email' => 'dhutacarwash77@gmail.com',  // Ganti dengan email admin
            'password' => Hash::make('@Sampoerna12'), // Menggunakan bcrypt untuk hashing password
        ]);

        // Membuat bos
        User::create([
            'name' => 'Bos',
            'email' => 'dhutacarwash77@gmail.com',  // Ganti dengan email bos
            'password' => Hash::make('@Sampoerna12'), // Menggunakan bcrypt untuk hashing password
        ]);
    }
}

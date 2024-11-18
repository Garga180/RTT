<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Guest user',
            'email' => 'guest@g.com',
            'password' => Hash::make('password'), // állítsd be az alapértelmezett jelszót
            'role' => 'guest', // ha van ilyen meződ az admin jogosultságra
        ]);
    }
}

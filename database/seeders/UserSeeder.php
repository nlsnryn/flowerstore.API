<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Nelson Ryan',
            'last_name' => 'Arabit',
            'email' => "nelsonarabit00@gmail.com",
            'mobile_number' => "09305782924",
            'address' => "Binangonan, Rizal",
            'status' => "active",
            "password" => Hash::make("password"),
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'role' => 'admin',
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [   
                'role' => 'owner',
                'name' => 'owner',
                'email' => 'owner@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [   
                'role' => 'user',
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('12345678'),
            ],
        ]);
    }
}

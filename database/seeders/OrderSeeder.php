<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $deadline = '2023-09-06';
        DB::table('order')->insert([
            'name_pelanggan' => 'yusril iza',
            'name_jasa' => 'bikin stiker logo',
            'price' => 10000,
            'deadline' => $deadline
        ]);
    }
}

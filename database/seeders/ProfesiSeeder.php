<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profesi')->insert([
            ['name' => 'Desainer'],
            ['name' => 'Outdor'],
            ['name' => 'DTF'],
            ['name' => 'Konika'],
            ['name' => 'Laser']
        ]);
    }
}

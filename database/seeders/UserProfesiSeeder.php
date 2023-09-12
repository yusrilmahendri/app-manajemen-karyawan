<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profesi;
use Illuminate\Support\Facades\DB;

class UserProfesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $user = User::inRandomOrder()->first()->id;
        $profesi = Profesi::inRandomOrder()->first()->id;
        DB::table('user_profesi')->insert([
            [
                'user_id' => $user,
                'profesi_id' => $profesi
            ],
        ]);
    }
}

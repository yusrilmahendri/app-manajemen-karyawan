<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;
use App\Models\Profesi;
use Illuminate\Support\Facades\DB;

class OrderProfesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::inRandomOrder()->first()->id;
        $profesi = Profesi::inRandomOrder()->first()->id;
        $order = Order::inRandomOrder()->first()->id;
        DB::table('order_user')->insert([
            [
                'order_id' => $order,
                'user_id' => $user,
                'profesi_id' => $profesi,
                'users_id' => $user,
            ],
        ]);
    }
}

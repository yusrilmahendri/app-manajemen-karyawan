<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LeadTime;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class LeadTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = Product::inRandomOrder()->first()->id;
        DB::table('lead_times')->insert([    
            [
                'product_id' => $product,
                'notification' => 'Barang ini sudah melebihi dari tenggat waktu',
                'created_at' => Carbon::now(),
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BufferStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = Product::inRandomOrder()->first()->id;
        DB::table('buffer_stocks')->insert([    
            [
                'product_id' => $product,
                'buffer_quantity' => 10,
                'reason' => 'Silahkan order tambah barang',
                'created_at' => Carbon::now(),
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;
use App\Models\Categori;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplier = Supplier::inRandomOrder()->first()->id;
        $categori = Categori::inRandomOrder()->first()->id;
        DB::table('products')->insert([    
            [
                'id' => 031,
                'supplier_id' => $supplier,
                'category_id' => $categori,
                'name' => 'Ultra Milk',
                'harga_unit' => rand(1000, 10000),
                'total_persediaan' => rand(5, 10),
                'created_at' => Carbon::now(),
            ]
        ]);
    }
}

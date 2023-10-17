<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('name_pelanggan');
            $table->string('name_jasa');
            $table->enum('category', ['umum', 'mitra']);
            $table->integer('price');
            $table->date('deadline');
            $table->integer('qty_desainer')->default(0);
            $table->integer('qty_dtf')->default(0);
            $table->integer('qty_konika')->default(0);
            $table->integer('qty_laser')->default(0);
            $table->integer('qty_outdor')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};

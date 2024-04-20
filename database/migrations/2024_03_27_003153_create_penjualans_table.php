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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id('id_penjualan');
            $table->string('kode_penjualan', 20);
            $table->date('tanggal');
            $table->decimal('total_harga',10, 0)->nullable();
            $table->integer('id_user');
            $table->integer('id_pelanggan');
            $table->decimal('bayar',10,0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};

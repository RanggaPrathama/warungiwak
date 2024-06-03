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
        Schema::create('detail_pemesanans', function (Blueprint $table) {
            $table->id('idDetail_pemesanan');
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_pemesanan');
            $table->integer('quantity');
            $table->integer('harga_product');
            $table->foreign('id_product')->references('id_product')->on('products')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('id_pemesanan')->references('id_pemesanan')->on('pemesanans')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pemesanans');
    }
};

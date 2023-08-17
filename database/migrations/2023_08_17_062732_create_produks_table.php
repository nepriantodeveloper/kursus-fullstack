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
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_produk',255);
            $table->bigInteger('kode_produk');
            $table->integer('id_kategori');
            $table->string('merk',50);
            $table->bigInteger('harga_beli');
            $table->bigInteger('harga_jual');
            $table->integer('diskon');
            $table->integer('stok');
            $table->string('satuan',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};

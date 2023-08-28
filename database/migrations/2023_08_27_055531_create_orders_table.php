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
            $table->foreignId('member_id')->onDelete('cascade');
            $table->string('invoice_no', 31)->unique()->index();
            $table->bigInteger('total_harga');
            $table->bigInteger('total_barang');
            $table->enum( 'status', ['IN_CART', 'PENDING', 'SUCCESS', 'FAILED'] )->index();
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

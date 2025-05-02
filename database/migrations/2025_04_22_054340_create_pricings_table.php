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
        Schema::create('pricings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('listings_id')->unsigned()->index()->nullable();
            $table->foreign('listings_id')->references('id')->on('listings')->onDelete('cascade');
            $table->decimal('harga_jual');
            $table->decimal('nilai_pasar');
            $table->decimal('sisa_pokok');
            $table->decimal('bunga_denda');
            $table->string('pola_penjualan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricings');
    }
};

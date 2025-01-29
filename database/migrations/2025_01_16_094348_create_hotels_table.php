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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            //id paket
            $table->integer('paket_id');
            //nama hotel
            $table->string('nama_hotel')->nullable();
            //lokasi
            $table->string('lokasi')->nullable();
            //deskripsi
            $table->text('deskripsi')->nullable();
            //bintang
            $table->integer('bintang')->nullable();
            //check_in
            $table->string('check_in')->nullable();
            //check_out
            $table->string('check_out')->nullable();
            //image
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};

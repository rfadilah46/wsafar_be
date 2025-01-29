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
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();
            // tipe paket
            $table->string('tipe_paket')->nullable();
            //slug, unique
            $table->string('slug')->unique();
            // nama paket
            $table->string('nama_paket')->nullable();
            // durasi
            $table->string('durasi')->nullable();
            // pemberangkatan
            $table->string('pemberangkatan')->nullable();
            // maskapai
            $table->string('maskapai')->nullable();
            // harga_quad
            $table->integer('harga_quad')->nullable();
            // harga_triple
            $table->integer('harga_triple')->nullable();
            // harga_double
            $table->integer('harga_double')->nullable();
            // thumbnail
            $table->string('thumbnail')->nullable();
            // flyer
            $table->string('flyer')->nullable();
            // deskripsi
            $table->text('deskripsi')->nullable();
            // total_pax
            $table->integer('total_pax')->nullable();
            // sisa_seat
            $table->integer('sisa_pax')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};

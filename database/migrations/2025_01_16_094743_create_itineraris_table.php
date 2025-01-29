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
        Schema::create('itineraris', function (Blueprint $table) {
            $table->id();
            //id paket
            $table->integer('paket_id');
            //name
            $table->string('name')->nullable();
            //hari, nullable
            $table->integer('hari')->nullable();
            //tanggal, nullable
            $table->date('tanggal')->nullable();
            //deskripsi
            $table->text('deskripsi');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itineraris');
    }
};

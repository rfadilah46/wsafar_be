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
        Schema::create('maskapais', function (Blueprint $table) {
            $table->id();
            //id paket
            $table->integer('paket_id');
            //nama maskapai
            $table->string('nama_maskapai')->nullable();
            //arrival
            $table->string('arrival')->nullable();
            //departure
            $table->string('departure')->nullable();
            //date_arrival
            $table->date('date_arrival')->nullable();
            //date_departure
            $table->date('date_departure')->nullable();
            //gate, nullable
            $table->string('gate')->nullable();
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
        Schema::dropIfExists('maskapais');
    }
};

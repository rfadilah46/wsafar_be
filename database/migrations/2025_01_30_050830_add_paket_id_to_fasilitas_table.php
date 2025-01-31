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
        Schema::table('fasilitas', function (Blueprint $table) {
            $table->unsignedBigInteger('paket_id')->after('nama')->nullable();
            
            // Jika ingin menambahkan foreign key
            // $table->foreign('paket_id')->references('id')->on('pakets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fasilitas', function (Blueprint $table) {
            $table->dropColumn('paket_id');
            
            // Jika sebelumnya ada foreign key, hapus juga
            // $table->dropForeign(['paket_id']);
        });
    }
};
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerari extends Model
{
    use HasFactory;

    // Tentukan kolom-kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'paket_id',
        'name',
        'hari',
        'tanggal',
        'deskripsi',
    ];

    /**
     * Relasi dengan model Paket
     */
    public function paket()
    {
        return $this->belongsTo(Pakets::class, 'paket_id');
    }


}

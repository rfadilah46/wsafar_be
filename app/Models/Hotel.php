<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    // Tentukan kolom-kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'paket_id',
        'nama_hotel',
        'lokasi',
        'deskripsi',
        'bintang',
        'check_in',
        'check_out',
        'image',
    ];

    /**
     * Relasi dengan model Paket
     */
    public function paket()
    {
        return $this->belongsTo(Pakets::class, 'paket_id');
    }

}

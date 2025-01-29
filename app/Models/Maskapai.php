<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maskapai extends Model
{
    use HasFactory;

    // Tentukan kolom-kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'paket_id',
        'nama_maskapai',
        'arrival',
        'departure',
        'date_arrival',
        'date_departure',
        'gate',
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    // Tentukan kolom-kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'tipe_paket',
        'nama_paket',
        'slug',
        'durasi',
        'pemberangkatan',
        'maskapai',
        'harga_quad',
        'harga_triple',
        'harga_double',
        'thumbnail',
        'flyer',
        'deskripsi',
        'total_pax',
        'sisa_pax',
        'currency',
        'rating_hotel',
        'tanggal_keberangkatan',
        'keterangan',
    ];

    public function hotels()
    {
        return $this->hasMany(Hotel::class, 'paket_id');
    }

    public function itineraris()
    {
        return $this->hasMany(Itinerari::class, 'paket_id');
    }

    public function maskapais()
    {
        return $this->hasMany(Maskapai::class, 'paket_id');
    }

    public function pembimbings()
    {
        return $this->hasMany(Pembimbing::class, 'paket_id');
    }

    public function hargaTermasuks()
    {
        return $this->hasMany(HargaTermasuk::class, 'paket_id');
    }

    public function hargaTidakTermasuks()
    {
        return $this->hasMany(HargaTidakTermasuk::class, 'paket_id');
    }

    public function keunggulans()
    {
        return $this->hasMany(Keunggulan::class, 'paket_id');
    }

    public function syaratKetentuans()
    {
        return $this->hasMany(SyaratKetentuan::class, 'paket_id');
    }

    //fasilitas, hasmany
    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class, 'paket_id');
    }
    




}

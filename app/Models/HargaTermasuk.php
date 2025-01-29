<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaTermasuk extends Model
{
    use HasFactory;
    //fillable
    protected $fillable = [
        'paket_id',
        'keterangan'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaTidakTermasuk extends Model
{
    use HasFactory;
    //fillable
    protected $fillable = [
        'paket_id',
        'keterangan'
    ];
}

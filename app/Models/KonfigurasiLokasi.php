<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonfigurasiLokasi extends Model
{
    use HasFactory;

    protected $table = "konfigurasi_lokasi";

    protected $fillable = [
        'lokasi_kantor',
        'radius'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'nik',
        'nama_lengkap',
        'jabatan',
        'no_hp',
        'password',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';

    protected $fillable = [
        'nama',
        'slug',
        'harga_coret',
        'harga',
        'komisi_agen',
        'komisi_sub_agen',
        'gambar',
        'link',
        'tampil',
        'aktif',
        'mulai_event',
        'akhir_event',
    ];

    protected $casts = [
        'mulai_event' => 'datetime',
        'akhir_event' => 'datetime',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHQ extends Model
{
    use HasFactory;

    protected $connection = 'second_mysql';
    protected $table = 'transactions';

    protected $fillable = [
        'uuid',
        'id_event',
        'id_agen',
        'email',
        'nama',
        'nohp',
        'panggilan',
        'tgllahir',
        'gender',
        'domisili',
        'konfirmasi',
        'tolaktf',
        'status',
        'jenis',
        'bukti_tf',
        'waktu_upload',
        'waktu_konfirmasi',
        'waktu_tolaktf',
        'total',
        'komisi',
        'kodeunik',
        'Keterangan'
    ];
}

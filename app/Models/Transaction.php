<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'user_id',
        'kelas_id',
        'id_ipaymu',
        'subtotal',
        'fee',
        'total',
        'batas_bayar',
        'via',
        'channel',
        'status_desc',
        'status_pembayaran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}

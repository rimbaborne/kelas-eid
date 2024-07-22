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
        'agen_id',
        'invoice_id',
        'sistem_lama_id',
        'id_ipaymu',
        'subtotal',
        'fee',
        'total',
        'batas_bayar',
        'berhasil_bayar',
        'via',
        'channel',
        'payment_number',
        'payment_name',
        'status_desc',
        'status_pembayaran',
        'status_pembayaran_code',
        'qris_string',
        'qris_nmid',
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

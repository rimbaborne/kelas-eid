<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agen extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'kode_notelp',
        'notelp',
        'tgl_lahir',
        'alamat',
        'kota',
        'gender',
        'nama_rek',
        'no_rek',
        'bank_rek',
        'status_agen',
        'sub_agen_id',
        'status_aktif',
        'foto',
        'user_id',
        'active',
        'pengaturan',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

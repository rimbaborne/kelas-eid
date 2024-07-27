<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Agen;
use App\Models\Kelas;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'agen_id',
        'kelas_id',
        'active',
        'data',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function agen()
    {
        return $this->belongsTo(Agen::class, 'agen_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
}

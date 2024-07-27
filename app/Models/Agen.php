<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agen extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'active',
        'pengaturan'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

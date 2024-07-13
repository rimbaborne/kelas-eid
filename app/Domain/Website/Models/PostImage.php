<?php

namespace App\Domain\Website\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'file_name',
        'description',
        'mime_type',
    ];
}

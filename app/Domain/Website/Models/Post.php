<?php

namespace App\Domain\Website\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_page',
        'content',
        'slug',
        'user_id',
        'status',
        'featured_image',
        'meta_description',
        'meta_keyword',
        'meta_url',
    ];
}

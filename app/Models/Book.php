<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'cover_photo',
        'author_id',
        'genre_id',
    ];
}

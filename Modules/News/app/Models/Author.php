<?php

namespace Modules\News\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Modules\News\Database\Factories\AuthorFactory;

class Author extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'image',
        'status',
        'description',

    ];

    // protected static function newFactory(): AuthorFactory
    // {
    //     // return AuthorFactory::new();
    // }
}

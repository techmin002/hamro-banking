<?php

namespace Modules\News\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Modules\News\Database\Factories\NewsCategoryFactory;

class NewsCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'image',
        'parents_id',
        'status',
    ];

    // protected static function newFactory(): NewsCategoryFactory
    // {
    //     // return NewsCategoryFactory::new();
    // }
}

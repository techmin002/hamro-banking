<?php

namespace Modules\News\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Modules\News\Database\Factories\NewsFactory;

class News extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'types_id',
        'author_id',
        'thumbnail',
        'short_description',
        'description',
        'schedule',
        'schedule_time',
        'tags',
        'news_section',
        'status',
    ];

    // protected static function newFactory(): NewsFactory
    // {
    //     // return NewsFactory::new();
    // }
}

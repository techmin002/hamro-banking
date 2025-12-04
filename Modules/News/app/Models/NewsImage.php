<?php

namespace Modules\News\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Modules\News\Database\Factories\NewsImageFactory;

class NewsImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['news_id', 'image', 'status'];

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    // protected static function newFactory(): NewsImageFactory
    // {
    //     // return NewsImageFactory::new();
    // }
}

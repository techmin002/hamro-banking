<?php

use Illuminate\Support\Facades\Route;
use Modules\News\Http\Controllers\AuthorController;
use Modules\News\Http\Controllers\NewsCategoryController;
use Modules\News\Http\Controllers\NewsController;
use Modules\News\Http\Controllers\NewsTypeController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('news', NewsController::class)->names('news');
    Route::get('news/status/{id}', [NewsController::class, 'status'])->name('news.status');

    Route::resource('categories', NewsCategoryController::class)->names('categories');
    Route::get('categories/status/{id}', [NewsCategoryController::class, 'status'])->name('categories.status');

    Route::resource('types', NewsTypeController::class)->names('types');
    Route::get('types/status/{id}', [NewsTypeController::class, 'status'])->name('types.status');

    Route::resource('author', AuthorController::class)->names('author');
    Route::get('author/status/{id}', [AuthorController::class, 'status'])->name('author.status');

    Route::get('newsimages/{id}', [NewsController::class, 'newsimages'])->name('news.newsimages');
    Route::post('newsimages/store', [NewsController::class, 'newsimages_store'])->name('news.newsimages_store');
    Route::get('newsimages/status/{id}', [NewsController::class, 'newsimagesstatus'])->name('news.newsimages_status');
    Route::delete('newsimages/destroy/{id}', [NewsController::class, 'newsimagesdestroy'])->name('news.newsimages_destroy');

});

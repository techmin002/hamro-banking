<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Modules\Advertisement\Http\Controllers\AdvertisementController;
use Modules\Advertisement\Http\Controllers\ClientController;

Route::group(['middleware' => 'auth'], function () {
    Route::resource('advertisements', 'AdvertisementController');
    Route::get('advertisement/status/{id}', [AdvertisementController::class, 'status'])->name('advertisement.status');

    Route::resource('clients', ClientController::class)->names('clients');
    Route::get('clients/status/{id}', [ClientController::class, 'status'])->name('clients.status');

});

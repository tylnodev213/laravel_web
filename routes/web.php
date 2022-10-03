<?php

use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;


Route::get('/', [TeamController::class, 'index']);


Route::group(['prefix'=>'Team', 'as'=>'Team.'],function () {

    Route::get('/search', [TeamController::class, 'index'])->name('search');

    Route::get('/create', [TeamController::class, 'create'])->name('create');

    Route::post('/create_confirm', [TeamController::class, 'create_confirm'])->name('create_confirm');

    Route::post('/create', [TeamController::class, 'store'])->name('store');

});

<?php

use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'process_login'])->name('process_login');

Route::group(['prefix'=>'Team', 'as'=>'Team.'],function () {

    Route::get('/search', [TeamController::class, 'index'])->name('search');

    Route::get('/create', [TeamController::class, 'create'])->name('create');

    Route::post('/store', [TeamController::class, 'store'])->name('store');

    Route::post('/create_confirm', [TeamController::class, 'create_confirm'])->name('create_confirm');

    Route::delete('/destroy/{team}', [TeamController::class, 'destroy'])->name('destroy');

    Route::get('/edit/{team}', [TeamController::class, 'edit'])->name('edit');

    Route::post('/edit/{team}', [TeamController::class, 'edit_confirm'])->name('edit_confirm');

    Route::put('/edit/{team}', [TeamController::class, 'update'])->name('update');

});

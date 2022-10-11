<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TeamController;
use App\Http\Middleware\CheckLoginMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'process_login'])->name('process_login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix'=>'Team', 'as'=>'Team.', 'middleware'=> CheckLoginMiddleware::class],function () {

    Route::get('/search', [TeamController::class, 'index'])->name('search');

    Route::get('/create', [TeamController::class, 'create'])->name('create');

    Route::post('/store', [TeamController::class, 'store'])->name('store');

    Route::post('/create_confirm', [TeamController::class, 'create_confirm'])->name('create_confirm');

    Route::delete('/destroy/{team}', [TeamController::class, 'destroy'])->name('destroy');

    Route::get('/edit/{team}', [TeamController::class, 'edit'])->name('edit');

    Route::post('/edit/{team}', [TeamController::class, 'edit_confirm'])->name('edit_confirm');

    Route::put('/edit/{team}', [TeamController::class, 'update'])->name('update');

});

Route::group(['prefix'=>'Employee', 'as'=>'Employee.', 'middleware'=> CheckLoginMiddleware::class],function () {

    Route::get('/search', [EmployeeController::class, 'index'])->name('search');

    Route::get('/create', [EmployeeController::class, 'create'])->name('create');

    Route::post('/store', [EmployeeController::class, 'store'])->name('store');

    Route::post('/create_confirm', [EmployeeController::class, 'create_confirm'])->name('create_confirm');

    Route::delete('/destroy/{employee}', [EmployeeController::class, 'destroy'])->name('destroy');

    Route::get('/edit/{employee}', [EmployeeController::class, 'edit'])->name('edit');

    Route::post('/edit/{employee}', [EmployeeController::class, 'edit_confirm'])->name('edit_confirm');

    Route::put('/edit/{employee}', [EmployeeController::class, 'update'])->name('update');

    Route::get('exportFile', [EmployeeController::class, 'exportFile'])->name('export_file');
});

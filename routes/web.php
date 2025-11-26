<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ElementoController;
use App\Http\Controllers\MovimientoController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RevisionController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/revision', [RevisionController::class, 'index'])->name('revision.index');

Route::middleware('auth')->group(function () {
    Route::redirect('/', '/elementos');
    Route::resource('elementos', ElementoController::class);
    Route::resource('movimientos', MovimientoController::class);
});

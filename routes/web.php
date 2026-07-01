<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PemainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Route Publik (Guest)
|--------------------------------------------------------------------------
*/
Route::get('/', [PemainController::class, 'home'])->name('home');
Route::get('/pemain/{pemain}', [PemainController::class, 'show'])->name('pemain.show');

/*
|--------------------------------------------------------------------------
| Route Autentikasi
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Route Admin (Protected — middleware auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [PemainController::class, 'index'])->name('dashboard');
    Route::get('/pemain/create', [PemainController::class, 'create'])->name('pemain.create');
    Route::post('/pemain', [PemainController::class, 'store'])->name('pemain.store');
    Route::get('/pemain/{pemain}/edit', [PemainController::class, 'edit'])->name('pemain.edit');
    Route::put('/pemain/{pemain}', [PemainController::class, 'update'])->name('pemain.update');
    Route::delete('/pemain/{pemain}', [PemainController::class, 'destroy'])->name('pemain.destroy');
    Route::get('/pemain/export-pdf', [PemainController::class, 'exportPdf'])->name('pemain.exportPdf');
});

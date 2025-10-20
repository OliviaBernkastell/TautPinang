<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TautanController; // ✅ TAMBAH INI
use App\Http\Controllers\GoogleController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

// Google OAuth Routes
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    // Dashboard
    Route::get('/dashboard', App\Http\Livewire\Dashboard::class)->name('dashboard');

    // Buat Tautan
    Route::get('/buat-tautan', App\Http\Livewire\BuatTautan::class)->name('buat-tautan');

    // Kelola Tautan
    Route::get('/kelola-tautan', App\Http\Livewire\KelolaTautan::class)->name('kelola-tautan');

    // Edit Tautan - Route baru
    Route::get('/edit-tautan/{id}', App\Http\Livewire\EditTautan::class)->name('edit-tautan');

    // Test Tautan - Debug Route
    Route::get('/test-tautan', [TautanController::class, 'testAllData'])->name('tautan.test');
});

/*
|--------------------------------------------------------------------------
| ✅ DYNAMIC SLUG ROUTE - HARUS DI PALING BAWAH!
|--------------------------------------------------------------------------
| Route ini akan catch SEMUA URL yang belum didefinisikan di atas.
| Format: yourapp.com/slug-tautan
| Contoh: yourapp.com/bps-tanjungpinang
|--------------------------------------------------------------------------
*/
Route::get('/{slug}', [TautanController::class, 'show'])
    ->where('slug', '[a-zA-Z0-9\-_]+')
    ->name('tautan.show');

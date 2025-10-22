<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TautanController; // ✅ TAMBAH INI
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\UserManagementController;

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
    'verified',
    'active' // Check user status - prevents disabled users from accessing
])->group(function () {

    // Dashboard - Accessible by all authenticated active users
    Route::get('/dashboard', App\Http\Livewire\Dashboard::class)->name('dashboard');

    // Buat Tautan - Accessible by all authenticated active users
    Route::get('/buat-tautan', App\Http\Livewire\BuatTautan::class)->name('buat-tautan');

    // Kelola Tautan - Accessible by all authenticated active users (will filter by user in controller)
    Route::get('/kelola-tautan', App\Http\Livewire\KelolaTautan::class)->name('kelola-tautan');

    // Edit Tautan - Accessible by all authenticated active users (RoleMiddleware will check ownership)
    Route::get('/edit-tautan/{id}', App\Http\Livewire\EditTautan::class)->name('edit-tautan')->middleware('role');

    // User Management - Admin only route
    Route::get('/user-management', App\Http\Livewire\UserManagement::class)->name('user-management')->middleware('role');

    // Test Tautan - Admin only route
    Route::get('/test-tautan', [TautanController::class, 'testAllData'])->name('tautan.test')->middleware('admin');
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

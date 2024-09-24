<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TransaksiController;
use App\Models\transaksi;
use Illuminate\Support\Facades\Route;

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

// Dashboard
Route::get('/dashboard', [TransaksiController::class, 'index'])->name('dashboard')->middleware('auth');

// CRUD Transaksi
Route::middleware('auth')->group(function () {
    Route::delete('/transaksiDel/{id}', [TransaksiController::class, 'delete'])->name('proses-delete-transaksi');
    Route::get('/transaksiViewCreate/{type}', [TransaksiController::class, 'transaksiViewCreate'])->name('tambah-transaksi');
    Route::post('/transaksiCreate/{type}', [TransaksiController::class, 'transaksiCreate'])->name('proses-tambah-transaksi');
    Route::get('/transaksiViewEdit/{id}', [TransaksiController::class, 'transaksiViewEdit'])->name('edit-transaksi');
    Route::put('/transaksiEdit/{id}', [TransaksiController::class, 'transaksiEdit'])->name('proses-edit-transaksi');
});

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/loginProcess', [AuthController::class, 'loginProcess'])->name('proses-login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/registerProcess', [AuthController::class, 'registerProcess'])->name('process-register');
Route::get('/setup', [AuthController::class, 'showSetup'])->name('setup');
Route::post('/setupProcess/{id}', [AuthController::class, 'setupProcess'])->name('process-setup');
Route::post('/logout', [AuthController::class, 'logout'])->name('proses-logout');

// Group
Route::get('/group', [GroupController::class, 'index'])->name('group-view');

// Test (Experimental)
Route::get('/test', [TransaksiController::class, 'test']);


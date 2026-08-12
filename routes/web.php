<?php

use App\Http\Controllers\AdminController;
use Dflydev\DotAccessData\Data;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/pesan/{id}', [PesanController::class, 'index']);
Route::post('/pesan/{id}', [PesanController::class, 'pesan']);
Route::get('check-out', [PesanController::class, 'check_out']);
Route::delete('check-out/{id}', [PesanController::class, 'delete']);
Route::post('konfirmasi-check-out', [PesanController::class, 'konfirmasi']);
Route::get('pembayaran/{id}', [PesananController::class, 'pembayaran']);
Route::post('pembayaran/{id}', [PesananController::class, 'konfirmasiPembayaran']);
Route::get('struk/{id}', [PesananController::class, 'struk']);

Route::get('history', [HistoryController::class, 'index']);
Route::get('history/{id}', [HistoryController::class, 'detail']);

Route::middleware(['auth'])->group(function () {
    Route::resource('/admin/barang', BarangController::class);
});

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/pesanan', [PesananController::class, 'admin']);
    Route::get('/admin/pesanan/{id}', [PesananController::class, 'detailAdmin']);
    Route::post('/admin/pesanan/{id}/kirim', [PesananController::class, 'kirim']);
    Route::post('/admin/pesanan/{id}/batal', [PesananController::class, 'batal']);

});

require __DIR__.'/auth.php';

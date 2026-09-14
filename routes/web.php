<?php

use App\Http\Controllers\AreaParkirController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ---------- Auth ----------
Route::get('/', fn () => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ---------- Authenticated ----------
Route::middleware(['auth.custom'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin only — master data & pengawasan
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('tarif', TarifController::class)->except(['show']);
        Route::resource('area', AreaParkirController::class)->except(['show']);
        Route::resource('kendaraan', KendaraanController::class)->except(['show']);
        Route::get('/log', [LogAktivitasController::class, 'index'])->name('log.index');
    });

    // Petugas only — operasional transaksi
    Route::middleware('role:petugas')->prefix('transaksi')->name('transaksi.')->group(function () {
        Route::get('/', [TransaksiController::class, 'index'])->name('index');
        Route::get('/masuk', [TransaksiController::class, 'create'])->name('create');
        Route::post('/masuk', [TransaksiController::class, 'store'])->name('store');
        Route::post('/{transaksi}/checkout', [TransaksiController::class, 'checkout'])->name('checkout');
        Route::get('/{transaksi}/struk', [TransaksiController::class, 'struk'])->name('struk');
    });

    // Owner only — rekap transaksi
    Route::middleware('role:owner')->get('/rekap', [RekapController::class, 'index'])->name('rekap.index');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuPublikController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\AdminAkunController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\StokController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KetersediaanController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\LaporanController;

// ══ PUBLIC ═══════════════════════════════════════════════

Route::get('/', fn() => view('splash'))->name('splash');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuPublikController::class, 'index'])->name('menu.index');
Route::get('/tentang', fn() => view('tentang'))->name('tentang');
Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi');

// ══ LUPA PASSWORD ════════════════════════════════════════

Route::get('/lupa-password',             [PasswordResetController::class, 'showForm'])     ->name('password.forgot');
Route::post('/lupa-password/verifikasi', [PasswordResetController::class, 'checkEmail'])  ->name('password.email.check');
Route::post('/lupa-password/simpan',     [PasswordResetController::class, 'savePassword'])->name('password.reset.save');

// ══ AUTH ═════════════════════════════════════════════════

Route::get('/login', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('kasir.pos');
    }
    return view('auth.login');
})->name('login');

Route::post('/login',  [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ══ ADMIN ════════════════════════════════════════════════

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Laporan
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');

        // Menu CRUD
        Route::get('/menu',         [MenuController::class, 'index'])  ->name('menu');
        Route::post('/menu',        [MenuController::class, 'store'])  ->name('menu.store');
        Route::put('/menu/{id}',    [MenuController::class, 'update']) ->name('menu.update');
        Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');

        // Akun
        Route::get('/akun',                 [AdminAkunController::class, 'index'])             ->name('akun');
        Route::get('/akun/reset-password',  [AdminAkunController::class, 'resetPasswordForm'])->name('akun.reset-password');
        Route::post('/akun/reset-password', [AdminAkunController::class, 'resetPasswordSave'])->name('akun.reset-password.save');

        // Stok
        Route::get('/stok',               [StokController::class, 'index'])    ->name('stok');
        Route::post('/stok',              [StokController::class, 'store'])    ->name('stok.store');
        Route::patch('/stok/{id}/edit',   [StokController::class, 'editStok'])->name('stok.edit');
        Route::patch('/stok/{id}/adjust', [StokController::class, 'adjust'])  ->name('stok.adjust');
        Route::patch('/stok/{id}/restok', [StokController::class, 'restok'])  ->name('stok.restok');
        Route::delete('/stok/{id}',       [StokController::class, 'destroy']) ->name('stok.destroy');

        // Ketersediaan
        Route::get('/ketersediaan',                    [KetersediaanController::class, 'index'])           ->name('ketersediaan');
        Route::patch('/ketersediaan/{id}/toggle',      [KetersediaanController::class, 'toggle'])          ->name('ketersediaan.toggle');
        Route::post('/ketersediaan/aktifkan-semua',    [KetersediaanController::class, 'aktifkanSemua'])   ->name('ketersediaan.aktifkan');
        Route::post('/ketersediaan/nonaktifkan-semua', [KetersediaanController::class, 'nonaktifkanSemua'])->name('ketersediaan.nonaktifkan');

        // Transaksi
        Route::get('/transaksi',        [TransaksiController::class, 'index'])    ->name('transaksi');
        Route::get('/transaksi/export', [TransaksiController::class, 'exportCsv'])->name('transaksi.export');
    });

// ══ KASIR ════════════════════════════════════════════════

Route::middleware(['auth', 'role:kasir'])
    ->prefix('kasir')
    ->name('kasir.')
    ->group(function () {
        Route::get('/pos',                   [KasirController::class, 'pos'])          ->name('pos');
        Route::post('/pos/proses',           [KasirController::class, 'proses'])       ->name('pos.proses');
        Route::get('/antrian',               [KasirController::class, 'antrian'])      ->name('antrian');
        Route::post('/antrian/{id}/selesai', [KasirController::class, 'tandaiSelesai'])->name('antrian.selesai');
        Route::post('/antrian/hapus',        [KasirController::class, 'hapusRiwayat']) ->name('antrian.hapus');
    });
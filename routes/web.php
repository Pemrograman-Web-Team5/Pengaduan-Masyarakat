<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\MasyarakatController;
use App\Http\Controllers\Admin\TanggapanController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('pekat.index');

Route::post('/login/auth', [UserController::class, 'login'])->name('pekat.login');

Route::get('/register', [UserController::class, 'formRegister'])->name('pekat.formRegister');
Route::post('/register/auth', [UserController::class, 'register'])->name('pekat.register');

Route::post('/store', [UserController::class, 'storePengaduan'])->name('pekat.store');
Route::get('/laporan/{siapa?}', [UserController::class, 'laporan'])->name('pekat.laporan');

Route::get('/logout', [UserController::class, 'logout'])->name('pekat.logout');

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class,'formLogin'])->name('admin.formLogin');
    Route::post('/Login', [AdminController::class,'login'])->name('admin.login');
    Route::get('/logout', [AdminController::class,'logout'])->name('admin.logout');

    //Route::get('/admin/Login', [AdminController::class,'formLogin'])->name('admin.formLogin');
    //Route::post('/admin/Login', [AdminController::class,'login'])->name('admin.login');
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard.index');

    Route::resource('pengaduan', PengaduanController::class);
    Route::resource('petugas', PetugasController::class);
    Route::resource('masyarakat', MasyarakatController::class);
    Route::get('laporan', [LaporanController::class,'index'])->name('laporan.index');

    Route::post('getLaporan', [LaporanController::class,'getLaporan'])->name('laporan.getLaporan');
    Route::get('laporan/cetak/{from}/{to}', [LaporanController::class, 'cetakLaporan'])->name('laporan.cetakLaporan');

    Route::post('tanggapan/createOrUpdate', [TanggapanController::class,'createOrUpdate'])->name('tanggapan.createOrUpdate');
});
<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->name('pekat.index');

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
});
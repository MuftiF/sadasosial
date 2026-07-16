<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserManagementController;

// 1. Welcome Page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// 2. Authentication Pages
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Registrasi Lembaga / Perusahaan / Instansi (Subproses 1.2)
    Route::get('/register/lembaga', [AuthController::class, 'showRegisterLembagaForm'])->name('register.lembaga');
    Route::post('/register/lembaga', [AuthController::class, 'registerLembaga']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// 3. Dashboard Page (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    // 4. User Management Page (Protected + Admin Role required)
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
        Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [UserManagementController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');
    });
});

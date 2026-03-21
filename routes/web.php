<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistreController;
use App\Http\Controllers\RegistruController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('dashboard'));

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Registru CRUD
    Route::get('/registru', [RegistruController::class, 'create'])->name('registru.create');
    Route::post('/registru', [RegistruController::class, 'store'])->name('registru.store');
    Route::get('/editare-registru', [RegistruController::class, 'index'])->name('registru.index');
    Route::get('/registru/{id}/edit', [RegistruController::class, 'edit'])->name('registru.edit');
    Route::put('/registru/{id}', [RegistruController::class, 'update'])->name('registru.update');
    Route::delete('/registru/{id}', [RegistruController::class, 'destroy'])->name('registru.destroy');
    Route::get('/registru/{id}/bon', [RegistruController::class, 'bon'])->name('registru.bon');

    // Registre list
    Route::get('/registre', [RegistreController::class, 'index'])->name('registre.index');

    // PDF
    Route::get('/genereaza-registre', [PDFController::class, 'index'])->name('pdf.index');
    Route::get('/genereaza-registre/{userId}/{year}', [PDFController::class, 'generate'])->name('pdf.generate');

    // Profile
    Route::get('/schimba-parola', [ProfileController::class, 'showChangePassword'])->name('profile.change-password');
    Route::post('/schimba-parola', [ProfileController::class, 'changePassword'])->name('profile.change-password.post');
});

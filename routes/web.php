<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistreController;
use App\Http\Controllers\RegistruController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
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
    Route::post('/registru/ocr', [RegistruController::class, 'ocr'])->name('registru.ocr');

    // Registre list
    Route::get('/registre', [RegistreController::class, 'index'])->name('registre.index');

    // PDF
    Route::get('/genereaza-registre', [PDFController::class, 'index'])->name('pdf.index');
    Route::get('/genereaza-registre/{userId}/{year}', [PDFController::class, 'generate'])->name('pdf.generate');

    // Profile (legacy)
    Route::get('/schimba-parola', [ProfileController::class, 'showChangePassword'])->name('profile.change-password');
    Route::post('/schimba-parola', [ProfileController::class, 'changePassword'])->name('profile.change-password.post');

    // Account
    Route::get('/cont', [AccountController::class, 'index'])->name('account.index');
    Route::patch('/cont/profil', [AccountController::class, 'updateProfil'])->name('account.profil');
    Route::patch('/cont/parola', [AccountController::class, 'updateParola'])->name('account.parola');
    Route::post('/cont/firma', [AccountController::class, 'saveFirma'])->name('account.firma.save');

    // User management (admin only)
    Route::get('/management-users', [UserManagementController::class, 'index'])->name('users.manage');
    Route::patch('/management-users/{id}/approve', [UserManagementController::class, 'approve'])->name('users.approve');
});

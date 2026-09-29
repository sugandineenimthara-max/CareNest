<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\MotherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Mothers
    Route::get('/mothers', [MotherController::class, 'index'])->name('mothers.index');
    Route::get('/mothers/create', [MotherController::class, 'create'])->name('mothers.create');
    Route::post('/mothers', [MotherController::class, 'store'])->name('mothers.store');
    Route::get('/mothers/{id}', [MotherController::class, 'show'])->name('mothers.show');
    Route::get('/mothers/{id}/edit', [MotherController::class, 'edit'])->name('mothers.edit');
    Route::put('/mothers/{id}', [MotherController::class, 'update'])->name('mothers.update');
});


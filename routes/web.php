<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MotherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Mother Registration
Route::get('/register/mother', [AuthController::class, 'showRegisterMother'])->name('register.mother');
Route::post('/register/mother', [AuthController::class, 'registerMother']);

// Midwife Registration
Route::get('/register/midwife', [AuthController::class, 'showRegisterMidwife'])->name('register.midwife');
Route::post('/register/midwife', [AuthController::class, 'registerMidwife']);

// Protected Routes
Route::middleware('auth')->group(function () {
    
    // -------------------------------------------------------------
    // YOUR ROLE-BASED ROUTES (From main)
    // -------------------------------------------------------------
    // Generic Dashboard Redirect to fix route('dashboard') references
    Route::get('/dashboard', function() {
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user->role === 'provider' || $user->role === 'admin') return redirect()->route('admin.dashboard');
        if ($user->role === 'midwife') return redirect()->route('midwife.dashboard');
        if ($user->role === 'mother') return redirect()->route('mother.dashboard');
        return redirect()->route('login');
    })->name('dashboard');

    // Role-based Dashboards (Currently all point to DashboardController, but protected by RoleMiddleware)
    Route::middleware('role:provider')->get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::middleware('role:midwife')->get('/midwife/dashboard', [DashboardController::class, 'index'])->name('midwife.dashboard');
    Route::middleware('role:mother')->get('/mother/dashboard', [DashboardController::class, 'index'])->name('mother.dashboard');

    // Admin Midwife Approval
    Route::middleware('role:provider')->get('/admin/midwife-requests', [\App\Http\Controllers\AdminController::class, 'midwifeRequests'])->name('admin.midwife-requests');
    Route::middleware('role:provider')->post('/admin/midwife-requests/{id}/approve', [\App\Http\Controllers\AdminController::class, 'approveMidwife'])->name('admin.midwife.approve');
    Route::middleware('role:provider')->post('/admin/midwife-requests/{id}/reject', [\App\Http\Controllers\AdminController::class, 'rejectMidwife'])->name('admin.midwife.reject');


    // -------------------------------------------------------------
    // YOUR TEAMMATE'S ROUTES (From feature/mother-management)
    // -------------------------------------------------------------
    // Mothers
    Route::get('/mothers', [MotherController::class, 'index'])->name('mothers.index');
    Route::get('/mothers/create', [MotherController::class, 'create'])->name('mothers.create');
    Route::post('/mothers', [MotherController::class, 'store'])->name('mothers.store');
    Route::get('/mothers/{id}', [MotherController::class, 'show'])->name('mothers.show');
    Route::get('/mothers/{id}/edit', [MotherController::class, 'edit'])->name('mothers.edit');
    Route::put('/mothers/{id}', [MotherController::class, 'update'])->name('mothers.update');

});

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;

// Public Route
Route::get('/', function () {
    return view('welcome');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/interactions', [InteractionController::class, 'index'])->name('interactions.index');
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

// Resource Routes
Route::resource('customers', CustomerController::class);
Route::resource('interactions', InteractionController::class);
Route::resource('tickets', TicketController::class);

// Report Generation Route
Route::post('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');

// Auth Routes
require __DIR__.'/auth.php';

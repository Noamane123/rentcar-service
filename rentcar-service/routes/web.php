<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Routes publiques: connexion administrateur.
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Toutes les pages de gestion sont protégées par le middleware auth.
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Page d'accueil: tableau de bord.
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Routes CRUD générées par Laravel pour chaque module.
    Route::resource('cars', CarController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('users', UserController::class)->except(['show']);
});

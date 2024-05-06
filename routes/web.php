<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GestionBienController;
use App\Http\Controllers\LoueurProfileController;
use App\Http\Controllers\LoueurServiceController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/dashboard/profile', [LoueurProfileController::class, 'index'])
    ->name('loueur.profile')
    ->middleware(['auth', 'verified']);
Route::post('/dashboard/profile/update-password', [LoueurProfileController::class, 'updatePassword'])
    ->name('loueur.updatePassword')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/gestion-biens', [GestionBienController::class, 'index'])
    ->name('bien.index')
    ->middleware(['auth', 'verified']);
Route::get('/dashboard/gestion-biens/create', [GestionBienController::class, 'create'])
    ->name('bien.create')
    ->middleware(['auth', 'verified']);
Route::post('/dashboard/gestion-biens/create/store', [GestionBienController::class, 'store'])
    ->name('bien.store')
    ->middleware(['auth', 'verified']);
Route::post('/dashboard/gestion-biens/publication/true', [GestionBienController::class, 'publicationtrue'])
    ->name('publication.true')
    ->middleware(['auth', 'verified']);
Route::post('/dashboard/gestion-biens/publication/false', [GestionBienController::class, 'publicationfalse'])
    ->name('publication.false')
    ->middleware(['auth', 'verified']);
Route::delete('/dashboard/gestion-biens/delete/{id}', [GestionBienController::class, 'destroy'])
    ->name('bien.destroy')
    ->middleware(['auth', 'verified']);
Route::get('/dashboard/gestion-biens/edit/{id}', [GestionBienController::class, 'edit'])
    ->name('bien.edit')
    ->middleware(['auth', 'verified']);
Route::post('/dashboard/gestion-biens/update/{id}', [GestionBienController::class, 'update'])
    ->name('bien.update')
    ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

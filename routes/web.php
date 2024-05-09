<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BienDetailController;
use App\Http\Controllers\GestionBienController;
use App\Http\Controllers\BienCatalogueController;
use App\Http\Controllers\LoueurProfileController;
use App\Http\Controllers\LoueurServiceController;
use App\Http\Controllers\ServiceDetailController;
use App\Http\Controllers\GestionDemandeController;
use App\Http\Controllers\GestionServiceController;
use App\Http\Controllers\ServiceCatalogueController;

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

Route::get('/dashboard/gestion-services', [GestionServiceController::class, 'index'])
    ->name('service.index')
    ->middleware(['auth', 'verified']);
Route::get('/dashboard/gestion-services/create', [GestionServiceController::class, 'create'])
    ->name('service.create')
    ->middleware(['auth', 'verified']);
Route::post('/dashboard/gestion-services/create/store', [GestionServiceController::class, 'store'])
    ->name('service.store')
    ->middleware(['auth', 'verified']);
Route::post('/dashboard/gestion-services/publication/true', [GestionServiceController::class, 'publicationtrue'])
    ->name('publication-service.true')
    ->middleware(['auth', 'verified']);
Route::post('/dashboard/gestion-services/publication/false', [GestionServiceController::class, 'publicationfalse'])
    ->name('publication-service.false')
    ->middleware(['auth', 'verified']);
Route::delete('/dashboard/gestion-services/delete/{id}', [GestionServiceController::class, 'destroy'])
    ->name('service.destroy')
    ->middleware(['auth', 'verified']);
Route::get('/dashboard/gestion-services/edit/{id}', [GestionServiceController::class, 'edit'])
    ->name('service.edit')
    ->middleware(['auth', 'verified']);
Route::post('/dashboard/gestion-services/update/{id}', [GestionServiceController::class, 'update'])
    ->name('service.update')
    ->middleware(['auth', 'verified']);

Route::get('/infos/bien/{id}', [BienDetailController::class, 'index'])->name('detail.bien');
Route::post('/bien-demande', [BienDetailController::class, 'envoyerDemande'])
    ->name('bien.demande')
    ->middleware(['auth', 'verified']);

Route::get('/infos/service/{id}', [ServiceDetailController::class, 'index'])->name('detail.service');
Route::post('/service-demande', [ServiceDetailController::class, 'envoyerDemande'])
    ->name('service.demande')
    ->middleware(['auth', 'verified']);

Route::get('/catalogue/produits', [BienCatalogueController::class, 'index'])->name('bien.catalogue');
Route::get('/catalogue/services', [ServiceCatalogueController::class, 'index'])->name('service.catalogue');

Route::get('dashboard/mes-demandes', [GestionDemandeController::class, 'index'])
    ->name('demande.index')
    ->middleware(['auth', 'verified']);
Route::post('/mes-demandes/accepter-demande-bein/{demandeId}', [GestionDemandeController::class, 'accepterdemandebien'])->name('accepterdemande.bien');
Route::post('/mes-demandes/refuser-demande-bein/{demandeId}', [GestionDemandeController::class, 'refuserdemandebien'])->name('refuserdemande.bien');

Route::post('/mes-demandes/accepter-demande-service/{demandeId}', [GestionDemandeController::class, 'accepterdemandeservice'])->name('accepterdemande.service');
Route::post('/mes-demandes/refuser-demande-service/{demandeId}', [GestionDemandeController::class, 'refuserdemandeservice'])->name('refuserdemande.service');

Route::get('/paiement', [PaymentController::class, 'index'])
    ->name('payment.index')
    ->middleware(['auth', 'verified']);
Route::get('/paiement/{paiementId}', [PaymentController::class])
    ->name('payment.store')
    ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

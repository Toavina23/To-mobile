<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/redirectAuthUser', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    if (Auth::user()->is_admin == 1) {
        return redirect()->route('admin.home');
    }
    return redirect()->route('home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/trajets', [\App\Http\Controllers\TrajetController::class, 'index'])->name('home');
    Route::post('/trajets', [\App\Http\Controllers\TrajetController::class, 'store'])->name('chauffeur.create_trajet');
    Route::get('/trajets/ajout', [\App\Http\Controllers\TrajetController::class, 'create'])->name('chauffeur.ajout_trajet');
    Route::get('/trajets/{id}', [\App\Http\Controllers\TrajetController::class, 'show'])->name('chauffeur.show_trajet');
    Route::post('/trajets/update', [\App\Http\Controllers\TrajetController::class, 'update'])->name('chauffeur.update_trajet');
    Route::get('/typeecheances/ajout', [\App\Http\Controllers\TypeEcheanceController::class, 'create'])->name('all.ajout_type_echeance');
    Route::post('/typeecheances', [\App\http\Controllers\TypeEcheanceController::class, 'store'])->name('all.enregistrer_type_echeance');
    Route::get('/echeances/ajout', [\App\Http\Controllers\EcheanceController::class, 'create'])->name('all.payement_echeance');
    Route::post('/echeances', [\App\Http\Controllers\EcheanceController::class, 'store'])->name('all.enregistrement_payement_echeance');
    Route::get('/etatecheances', [\App\Http\Controllers\EcheanceController::class, 'etat'])->name('all.etat_echeance');
    Route::get('/vehicules/disponibilite', [\App\Http\Controllers\VehiculeController::class, 'vehiculeDisponibles'])->name('all.vehicule_disponnible');
    Route::get('/maintenances/ajout',[\App\Http\Controllers\MaintenanceController::class, 'create'])->name('all.ajout_maintenance');
    Route::post('/maintenances',[\App\Http\Controllers\MaintenanceController::class, 'store'])->name('all.enregistrer_maintenance');
    Route::get('/maintenances', [\App\Http\Controllers\MaintenanceController::class, 'index'])->name('all.etat_maintenance');
    Route::middleware(['admin'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/vehicules/stat/{id}', [\App\Http\Controllers\VehiculeController::class, 'grapheTrajet'])->name('admin.chart-vehicule');
            Route::post('/vehicules', [\App\Http\Controllers\VehiculeController::class, 'store'])->name('admin.create_vehicule');
            Route::get('/vehicules/ajout', [\App\Http\Controllers\VehiculeController::class, 'create'])->name('admin.ajouter_vehicule');
            Route::get('/vehicules/{id}/trajets/pdf', [\App\Http\Controllers\VehiculeController::class, 'pdfTrajetVehicule'])->name('admin.trajets_vehicule_pdf');
            Route::get('/home', [\App\Http\Controllers\VehiculeController::class, 'index'])->name('admin.home');
            Route::get('/commandes', [\App\Http\Controllers\CommandeController::class, 'index'])->name('admin.commandes');
            Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
            Route::get('/users/export', [App\Http\Controllers\UserController::class, 'export']);
            Route::get('/users/pdf', [App\Http\Controllers\UserController::class, 'toPdf']);
        });
    });
});



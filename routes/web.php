<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Importation de tous vos contrôleurs
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\BordereauController;
use App\Http\Controllers\VersementController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| ROUTES PUBLIQUES (Accessibles sans connexion)
|--------------------------------------------------------------------------
*/

// Page d'accueil racine -> redirige vers la connexion
Route::get('/', function () {
    return redirect('/login');
});

// Authentification (Login)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


/*
|--------------------------------------------------------------------------
| ROUTES PROTÉGÉES (Utilisateurs connectés uniquement)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // --- Déconnexion ---
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');

    // Fallback GET logout au cas où votre bouton utilise un lien simple
    Route::get('/logout', [AuthController::class, 'logout']);

    // --- LE DISPATCHER DE DASHBOARD UNIQUE ---
    // Cette route analyse le rôle de l'utilisateur connecté et l'aiguille vers son espace
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- LES TROIS DASHBOARDS EMS VOYAGE ---
    Route::get('/chef/dashboard', [DashboardController::class, 'chefIndex'])->name('chef.dashboard');
    Route::get('/comptable/dashboard', [DashboardController::class, 'comptableIndex'])->name('comptable.dashboard');
    Route::get('/comptoir/dashboard', [DashboardController::class, 'comptoirIndex'])->name('comptoir.dashboard');

    // --- GESTION DES UTILISATEURS / PERSONNEL ---
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users/store', [UserController::class, 'store']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // Inscription (Ancien système ou passerelle d'ajout si nécessaire)
    Route::get('/register', [RegisterController::class, 'show']);
    Route::post('/register', [RegisterController::class, 'store']);

    // --- PROFIL & SÉCURITÉ ---
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::get('/change-password', [ChangePasswordController::class, 'edit']);
    Route::post('/change-password', [ChangePasswordController::class, 'updatePassword']);

    // Doublon en français pour éviter les erreurs de liens cassés dans vos vues
    Route::get('/modifier-mot-de-passe', [ChangePasswordController::class, 'edit']);
    Route::post('/modifier-mot-de-passe', [ChangePasswordController::class, 'updatePassword']);

    // --- GESTION DES CLIENTS (Relation Client Intelligente) ---
    Route::get('/clients', [ClientController::class, 'index']);
    Route::get('/clients/create', [ClientController::class, 'create']);
    Route::post('/clients/store', [ClientController::class, 'store']);
    Route::delete('/clients/{id}', [ClientController::class, 'destroy']);

    // --- GESTION DES RÉSERVATIONS ---
    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::get('/reservations/create', [ReservationController::class, 'create']);
    Route::post('/reservations/store', [ReservationController::class, 'store']);
    Route::get('/reservations/{id}/{statut}', [ReservationController::class, 'updateStatus']);
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);

    // --- COMPTABILITÉ : FACTURES ---
    Route::get('/factures', [FactureController::class, 'index']);
    Route::get('/factures/create', [FactureController::class, 'create']);
    Route::post('/factures', [FactureController::class, 'store']);
    Route::get('/factures/{id}', [FactureController::class, 'show']);
    Route::get('/factures/{id}/payer', [FactureController::class, 'payer']);
    Route::get('/factures/{id}/pdf', [FactureController::class, 'exportPdf']);
    Route::delete('/factures/{id}', [FactureController::class, 'destroy']);

    // --- COMPTABILITÉ : PAIEMENTS, BORDEREAUX & VERSEMENTS ---
    Route::get('/paiements', [PaiementController::class, 'index'])->name('paiements.index');
    Route::post('/paiements', [PaiementController::class, 'store'])->name('paiements.store');
    Route::post('/paiements/store', [PaiementController::class, 'store']); // Fallback de sécurité

    Route::resource('bordereaux', BordereauController::class);
    Route::resource('versements', VersementController::class);

});

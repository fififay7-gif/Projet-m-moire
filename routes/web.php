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
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\BordereauController;
use App\Http\Controllers\VersementController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| ROUTES PUBLIQUES (Accessibles sans connexion)
|--------------------------------------------------------------------------
*/

// Modifie le tout début de tes routes publiques ainsi :
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard'); // Si déjà connecté, on l'envoie au trieur
    }
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
    Route::get('/admin/dashboard', [DashboardController::class, 'adminIndex'])->name('admin.dashboard');
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
    Route::resource('reservations', ReservationController::class);
    Route::post('/reservations/store', [ReservationController::class, 'store']);
    Route::get('/reservations/{id}/{statut}', [ReservationController::class, 'updateStatus']);
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);

Route::put('/reservations/{id}', [ReservationController::class, 'update']);

Route::get('/comptable/reservations', [ReservationController::class, 'reservations'])->name('comptable.reservations');
    // --- COMPTABILITÉ : FACTURES ---


    // --- COMPTABILITÉ : PAIEMENTS, BORDEREAUX & VERSEMENTS ---

    Route::post('/paiements', [PaiementController::class, 'store'])->name('paiements.store');
    Route::post('/paiements/store', [PaiementController::class, 'store']); // Fallback de sécurité
    // Assure-toi d'avoir uniquement ce bloc à la fin de ton fichier (supprime ses doublons s'il y en a)
Route::get('/comptable/paiements', [PaiementController::class, 'index'])->name('paiements.index');
Route::get('/comptable/paiements/{id}/bordereau', [PaiementController::class, 'showBordereau'])->name('comptable.paiements.bordereau');
});
// Route de secours pour attraper la mauvaise redirection de Laravel
Route::redirect('/user/dashboard', '/dashboard');


// Routes pour les Bordereaux
Route::get('/bordereaux', [BordereauController::class, 'index'])->name('bordereaux.index');
Route::post('/bordereaux/store', [BordereauController::class, 'store'])->name('bordereaux.store');

// Routes pour les Versements
Route::get('/versements', [VersementController::class, 'index'])->name('versements.index');
Route::post('/versements/store', [VersementController::class, 'store'])->name('versements.store');


Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus']);

Route::put('/users/{id}/update', [UserController::class, 'update']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chef/reservations', [ReservationController::class, 'chefIndex'])->name('chef.reservations')->middleware('auth');

// Route pour le bouton Valider
Route::get('/reservations/{id}/validated', [ReservationController::class, 'validateReservation'])->middleware('auth');

// Route pour le bouton Rejeter (POST car on envoie le motif de rejet)
Route::post('/reservations/{id}/reject', [ReservationController::class, 'rejectReservation'])->middleware('auth');

// Route pour remettre en attente
Route::post('/reservations/{id}/reset-status', [ReservationController::class, 'resetStatus'])->middleware('auth');

// Route pour la suppression définitive par le Chef
Route::delete('/reservations/{id}/delete', [ReservationController::class, 'destroyReservation'])->middleware('auth');
//  Route pour afficher le formulaire de modification (GET)


Route::resource('versements', VersementController::class);

//  Routes dédiées au Chef d'Agence pour la gestion des clients
Route::get('/chef/clients', [ClientController::class, 'chefIndex'])->name('chef.clients.index');
Route::get('/chef/clients/create', [ClientController::class, 'create'])->name('chef.clients.create');
Route::post('/chef/clients/store', [ClientController::class, 'store'])->name('chef.clients.store');
Route::get('/chef/clients/{id}/edit', [ClientController::class, 'edit'])->name('chef.clients.edit');
Route::put('/chef/clients/{id}', [ClientController::class, 'update'])->name('chef.clients.update');

//  Route pour le suivi des paiements du Chef d'agence (Lecture seule)
Route::get('/chef/paiements', [PaiementController::class, 'chefIndex'])->name('chef.paiements.index');

Route::post('/chef/reservations/{id}/traiter-paiement', [ReservationController::class, 'traiterPaiement']);
Route::patch('/chef/reservations/{id}/valider', [App\Http\Controllers\ReservationController::class, 'valider'])
     ->name('reservations.valider');

     Route::middleware(['auth'])->group(function () {
    Route::patch('/chef/reservations/{id}/valider', [ReservationController::class, 'valider']);
});


Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');

Route::resource('clients', App\Http\Controllers\ClientController::class);




Route::patch('/reservations/{id}/valider', [ReservationController::class, 'valider'])->name('reservations.valider');
Route::patch('/reservations/{id}/rejeter', [ReservationController::class, 'rejeter'])->name('reservations.rejeter');

Route::resource('paiements', PaiementController::class);

// Vérifiez que ces deux lignes existent dans routes/web.php
Route::put('/paiements/{id}', [PaiementController::class, 'update'])->name('paiements.update');
Route::delete('/paiements/{id}', [PaiementController::class, 'destroy'])->name('paiements.destroy');

// Route pour l'agent (existant)
Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');

// Nouvelle route pour le chef d'agence
Route::put('/reservations/{id}/statut', [ReservationController::class, 'updateStatut'])->name('reservations.updateStatut');

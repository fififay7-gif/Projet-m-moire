<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// PAGE D'ACCUEIL
Route::get('/', function () {
    return redirect('/login');
});

// LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// DASHBOARD (protégé)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// LOGOUT
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// REGISTER (admin seulement)
Route::middleware(['admin'])->group(function () {
    Route::get('/register', [RegisterController::class, 'show']);
    Route::post('/register', [RegisterController::class, 'store']);
});






Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])
    ->middleware('auth');

Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])
    ->middleware('auth');


use Illuminate\Support\Facades\Auth;


Route::post('/logout', function () {

    Auth::logout();

    return redirect('/login');

})->middleware('auth');






Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/user/dashboard', [DashboardController::class, 'userDashboard']);


});

use App\Http\Controllers\UserController;



Route::get('/users', [UserController::class, 'index']);

Route::post('/users/store', [UserController::class, 'store']);

Route::delete('/users/{id}', [UserController::class, 'destroy']);

    use App\Http\Controllers\ProfileController;

Route::get('/profile', [ProfileController::class, 'index'])
    ->middleware('auth');

use App\Http\Controllers\PasswordController;


Route::get('/modifier-mot-de-passe', [PasswordController::class, 'edit'])
    ->middleware('auth');

Route::post('/modifier-mot-de-passe', [PasswordController::class, 'updatePassword'])
    ->middleware('auth');








     use App\Http\Controllers\ChangePasswordController;


Route::middleware('auth')->group(function () {

    Route::get('/change-password', [ChangePasswordController::class, 'edit']);

    Route::post('/change-password', [ChangePasswordController::class, 'updatePassword']);
});

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\ClientController;

Route::middleware('auth')->group(function () {

    Route::get('/clients', [ClientController::class, 'index']);
    Route::get('/clients/create', [ClientController::class, 'create']);
    Route::post('/clients/store', [ClientController::class, 'store']);
    Route::delete('/clients/{id}', [ClientController::class, 'destroy']);

});

use App\Http\Controllers\ReservationController;

Route::middleware('auth')->group(function () {

    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::get('/reservations/create', [ReservationController::class, 'create']);
    Route::post('/reservations/store', [ReservationController::class, 'store']);

    Route::get('/reservations/{id}/{statut}', [ReservationController::class, 'updateStatus']);

    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);

});



use App\Http\Controllers\FactureController;

Route::middleware('auth')->group(function () {

    Route::get('/factures', [FactureController::class, 'index']);
    Route::get('/factures/create', [FactureController::class, 'create']);
    Route::post('/factures', [FactureController::class, 'store']);

    Route::get('/factures/{id}', [FactureController::class, 'show']);
    Route::delete('/factures/{id}', [FactureController::class, 'destroy']);

    Route::get('/factures/{id}/payer', [FactureController::class, 'payer']);

    Route::get('/factures/{id}/pdf', [FactureController::class, 'exportPdf']);
});

   use App\Http\Controllers\PaiementController;

Route::get('/paiements', [PaiementController::class, 'index'])->name('paiements.index');

//Route::get('/paiements/create', [PaiementController::class, 'create'])->name('paiements.create');

Route::post('/paiements', [PaiementController::class, 'store'])->name('paiements.store');
    Route::get('/comptable/dashboard', [DashboardController::class, 'comptableDashboard'])
    ->middleware('auth');
Route::post('/paiements/store',
    [PaiementController::class,'store'])
    ->name('paiements.store');

    use App\Http\Controllers\BordereauController;

    Route::resource('bordereaux', BordereauController::class);

    use App\Http\Controllers\VersementController;
Route::resource('versements', VersementController::class);

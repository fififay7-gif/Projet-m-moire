<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProduitController;
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


#dashboard
// Vérifiez que cette ligne existe bien :
Route::get('/stock', [ProduitController::class, 'index'])->name('stock.index');


use App\Http\Controllers\MouvementController;

Route::resource('mouvements', MouvementController::class);



Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])
    ->middleware('auth');

Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])
    ->middleware('auth');


use Illuminate\Support\Facades\Auth;


Route::post('/logout', function () {

    Auth::logout();

    return redirect('/login');

})->middleware('auth');


use App\Http\Controllers\StockController;
use App\Http\Controllers\AlerteController;
use App\Http\Controllers\IAController;

Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/user/dashboard', [DashboardController::class, 'userDashboard']);

    // PRODUITS
    Route::get('/produits', [ProduitController::class, 'index']);

    // STOCKS
    Route::get('/stocks', [StockController::class, 'index']);

    // MOUVEMENTS
    Route::get('/mouvements', [MouvementController::class, 'index']);

    // ALERTES
    Route::get('/alertes', [AlerteController::class, 'index']);

    // IA
    Route::get('/fiche-ia', [IAController::class, 'index']);

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



Route::get('/produits', [ProduitController::class, 'index']);
Route::get('/produits/create', [ProduitController::class, 'create']);
Route::post('/produits/store', [ProduitController::class, 'store']);




Route::get('/stocks', [StockController::class, 'index']);
Route::post('/stocks/update/{id}', [StockController::class, 'update']);
Route::delete('/stocks/delete/{id}', [StockController::class, 'destroy']);






Route::get('/change-password', function () {
    return view('auth.change-password');
})->middleware('auth');

Route::post('/change-password', [PasswordController::class, 'update'])
    ->middleware('auth');



Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

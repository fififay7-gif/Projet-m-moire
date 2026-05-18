<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Produit;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Redirection selon rôle
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        return redirect('/user/dashboard');
    }

    /**
     * DASHBOARD ADMIN
     */
   
public function adminDashboard()
{
    $user = Auth::user();

    if ($user->role !== 'admin') {
        abort(403);
    }

    $totalProduits = Produit::count();

    $stocksFaibles = Produit::where('quantite', '<=', 5)->count();

    $mouvementsAujourdhui = \App\Models\Mouvement::whereDate('created_at', today())->count();

    $totalUsers = User::count();

    return view('admin.dashboard', compact(
        'user',
        'totalProduits',
        'stocksFaibles',
        'mouvementsAujourdhui',
        'totalUsers'
    ));
}
    /**
     * DASHBOARD USER
     */
    public function userDashboard()
{
    $user = Auth::user();

    if ($user->role !== 'user') {
        abort(403);
    }

    $totalProduits = Produit::count();

    $stocksFaibles = Produit::where('quantite', '<=', 5)->count();

    return view('user.dashboard', compact(
        'user',
        'totalProduits',
        'stocksFaibles'
    ));
}

}

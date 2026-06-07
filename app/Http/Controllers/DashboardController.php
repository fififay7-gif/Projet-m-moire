<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Factures;
use App\Models\Paiement;
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

        $totalUsers = User::count();

        return view('admin.dashboard', compact(
            'user',
            'totalUsers'
        ));
    }

    /**
     * DASHBOARD CHEF AGENCE
     */
    public function chefDashboard()
    {
        $user = Auth::user();

        if ($user->role !== 'chef_agence') {
            abort(403);
        }

        return view('chef.dashboard', compact('user'));
    }

    /**
     * DASHBOARD AGENT COMPTOIR
     */
    public function agentDashboard()
    {
        $user = Auth::user();

        if ($user->role !== 'agent_comptoir') {
            abort(403);
        }

        return view('agent.dashboard', compact('user'));
    }

    /**
     * DASHBOARD COMPTABLE
     */
   

    /**
     * DASHBOARD USER NORMAL
     */
    public function userDashboard()
    {
        $user = Auth::user();

        if ($user->role !== 'user') {
            abort(403);
        }

        return view('user.dashboard', compact('user'));
    }

    public function comptableDashboard()
{
    $user = Auth::user();

    if ($user->role !== 'comptable') {
        abort(403);
    }

    $totalFactures = Factures::count();

    $totalEncaisse = Paiement::sum('montant_paye');

    $totalFacturesMontant = Factures::sum('montant');

    $resteAPayer = $totalFacturesMontant - $totalEncaisse;

    $facturesImpayees = Factures::where('statut', 'impayée')->count();

    $facturesPartielles = Factures::where('statut', 'partielle')->count();

    return view('comptable.dashboard', compact(
        'user',
        'totalFactures',
        'totalEncaisse',
        'resteAPayer',
        'facturesImpayees',
        'facturesPartielles'
    ));
}
}

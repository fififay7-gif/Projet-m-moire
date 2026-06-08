<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Point d'entrée unique (/dashboard) qui redirige l'utilisateur
     * vers le bon tableau de bord selon son rôle au sein d'EMS Voyage.
     */
    public function index()
    {
        $role = Auth::user()->role;

        switch ($role) {
            case 'administrateur':
                return redirect()->route('admin.dashboard');

            case 'chef_agence':
                return redirect()->route('chef.dashboard');

            case 'comptable':
                return redirect()->route('comptable.dashboard');

            case 'agent_comptoir':
                return redirect()->route('comptoir.dashboard');

            default:
                Auth::logout();
                return abort(403, 'Rôle non autorisé ou inconnu.');
        }
    }

    /**
     * Vue dédiée à l'Administrateur Système
     */
    public function adminIndex()
    {
        return view('dashboards.admin');
    }
    /**
     * Vue dédiée au Chef d'agence
     */
    public function chefIndex()
    {
        // Vous pourrez injecter ici vos statistiques de ventes globales plus tard
        return view('dashboards.chef');
    }

    /**
     * Vue dédiée au Comptable
     */
    public function comptableIndex()
    {
        // Vous pourrez injecter ici les données de la caisse ou des factures
        return view('dashboards.comptable');
    }

    /**
     * Vue dédiée à l'Agent de comptoir
     */
    public function comptoirIndex()
    {
        // Vous pourrez injecter ici les listes de réservations de billets du jour
        return view('dashboards.comptoir');
    }
}

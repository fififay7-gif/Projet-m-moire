<?php

namespace App\Http\Controllers;

use App\Models\Bordereau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BordereauController extends Controller
{
    // Afficher la liste des bordereaux
    public function index()
    {
        // Les comptables et admins voient tout, les agents de comptoir ne voient que les leurs
        if (Auth::user()->role === 'agent_comptoir') {
            $bordereaux = Bordereau::where('user_id', Auth::id())->latest()->get();
        } else {
            $bordereaux = Bordereau::with('user')->latest()->get();
        }

        return view('bordereaux.index', compact('bordereaux'));
    }

    // Enregistrer un nouveau bordereau
    public function store(Request $request)
    {
        $request->validate([
            'observations' => 'nullable|string',
        ]);

        // Génération automatique d'un code unique pour le bordereau (Ex: BR-2026-X)
        $code = 'BR-' . date('Y') . '-' . strtoupper(bin2hex(random_bytes(3)));

        Bordereau::create([
            'code_bordereau' => $code,
            'date_creation' => now(),
            'statut' => 'en_attente',
            'user_id' => Auth::id(),
            'observations' => $request->observations,
        ]);

        return redirect()->back()->with('success', 'Bordereau généré avec succès !');
    }
}

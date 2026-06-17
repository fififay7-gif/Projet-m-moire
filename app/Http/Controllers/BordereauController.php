<?php

namespace App\Http\Controllers;

use App\Models\Bordereau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paiement;
class BordereauController extends Controller {
    // La liste de tous les bordereaux (la page que tu as capturée)
    public function index() {
        $paiements = Paiement::latest()->get();
        return view('comptable.bordereaux.index', compact('paiements'));
    }

    // L'affichage d'un bordereau unique pour impression
    public function show($id) {
        $paiement = Paiement::with('client')->findOrFail($id);
        return view('comptable.bordereaux.show', compact('paiement'));
    }

    public function chefIndex()
{
    // Récupère tous les bordereaux du plus récent au plus ancien
    $bordereaux = Bordereau::latest()->get();

    // Renvoie vers le fichier : resources/views/chef/bordereaux.blade.php
    return view('chef.bordereaux', compact('bordereaux'));
}
}

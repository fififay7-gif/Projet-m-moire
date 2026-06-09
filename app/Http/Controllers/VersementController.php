<?php

namespace App\Http\Controllers;

use App\Models\Versement;
use App\Models\Bordereau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VersementController extends Controller
{
    public function index()
    {
        $versements = Versement::with(['user', 'bordereau'])->latest()->get();
        $bordereauxLibres = Bordereau::where('statut', 'en_attente')->get(); // Pour l'association

        return view('versements.index', compact('versements', 'bordereauxLibres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reference_versement' => 'required|string|unique:versements',
            'montant' => 'required|numeric|min:0',
            'banque' => 'required|string',
            'date_versement' => 'required|date',
            'bordereau_id' => 'nullable|exists:bordereaux,id',
        ]);

        Versement::create([
            'reference_versement' => $request->reference_versement,
            'montant' => $request->montant,
            'banque' => $request->banque,
            'date_versement' => $request->date_versement,
            'user_id' => Auth::id(),
            'bordereau_id' => $request->bordereau_id,
        ]);

        return redirect()->back()->with('success', 'Versement enregistré avec succès !');
    }
}

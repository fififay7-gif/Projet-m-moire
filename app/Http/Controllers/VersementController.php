<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Versement;
use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;

class VersementController extends Controller
{
    public function index()
    {
        //  withTrashed() permet de charger aussi les versements masqués/supprimés
        $versements = Versement::withTrashed()->with('paiement.client')->orderBy('created_at', 'desc')->get();
        $paiements = Paiement::with('client')->orderBy('created_at', 'desc')->get();

        return view('versements.index', compact('versements', 'paiements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'paiement_id'    => 'required|exists:paiements,id',
            'montant'        => 'required|numeric|min:0',
            'banque'         => 'required|string|max:255',
            'date_versement' => 'required|date',
        ]);

        $versement = new Versement();
        $versement->paiement_id   = $request->paiement_id;
        $versement->montant        = $request->montant;
        $versement->banque         = $request->banque;
        $versement->date_versement = $request->date_versement;
        $versement->reference_versement = 'VER-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(3)));
        $versement->user_id = Auth::check() ? Auth::id() : 5;
        $versement->save();

        return redirect()->route('versements.index')->with('success', 'Le versement a été enregistré avec succès !');
    }

    /**
     * Mettre à jour un versement (Modification)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'paiement_id'    => 'required|exists:paiements,id',
            'montant'        => 'required|numeric|min:0',
            'banque'         => 'required|string|max:255',
            'date_versement' => 'required|date',
        ]);

        $versement = Versement::findOrFail($id);
        $versement->update([
            'paiement_id'    => $request->paiement_id,
            'montant'        => $request->montant,
            'banque'         => $request->banque,
            'date_versement' => $request->date_versement,
        ]);

        return redirect()->route('versements.index')->with('success', 'Le versement a été modifié avec succès !');
    }

    /**
     * Supprimer logiquement un versement (Soft Delete)
     */
    public function destroy($id)
    {
        $versement = Versement::findOrFail($id);
        $versement->delete(); // Met juste à jour la colonne deleted_at

        return redirect()->route('versements.index')->with('warning', 'Le versement a été marqué comme supprimé.');
    }
}

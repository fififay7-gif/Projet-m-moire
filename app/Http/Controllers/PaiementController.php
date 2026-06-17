<?php
namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Factures;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Reservation;

class PaiementController extends Controller
{


public function index() {
        $paiements = Paiement::latest()->get();
        $clients = Client::all();
        // Affiche la liste des paiements et le formulaire de saisie
        return view('comptable.paiements.index', compact('paiements', 'clients'));
    }

    public function store(Request $request)
    {
        // 1. Récupération directe des données envoyées par le formulaire
        $data = $request->only(['client_id', 'montant', 'mode_paiement']);

        // 2. Ajout automatique de la date du jour
        $data['date_paiement'] = now()->format('Y-m-d');

        // 3. Insertion en base de données
        Paiement::create($data);

        // 4. Redirection vers le registre des paiements
        return redirect()->route('paiements.index')->with('success', 'Paiement enregistré avec succès.');
         }
public function showBordereau($id)
{
    //  On charge le paiement directement avec son client associé
    $paiement = Paiement::with('client')->findOrFail($id);

    return view('comptable.paiements.bordereau', compact('paiement'));
}

/**
 *  DIRECTION : CHEF D'AGENCE
 * Affiche l'historique des paiements en lecture seule (sans bouton d'ajout)
 */
public function chefIndex()
{
    // Récupère tous les paiements du plus récent au plus ancien avec les infos du client si la relation existe
    $paiements = \App\Models\Paiement::with('client')->latest()->get();

    // Renvoie vers la vue : resources/views/chef/paiements.blade.php
    return view('chef.paiements', compact('paiements'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'montant' => 'required|numeric',
        'mode_paiement' => 'required'
    ]);

    $paiement = Paiement::findOrFail($id);

    // On met à jour les données
    $paiement->update([
        'montant' => $request->montant,
        'mode_paiement' => $request->mode_paiement
    ]);

    return back()->with('success', 'Paiement #'.$id.' mis à jour avec succès.');
}

public function destroy($id)
{
    $paiement = Paiement::findOrFail($id);
    $paiement->delete();

    return back()->with('success', 'Paiement supprimé avec succès.');
}

}

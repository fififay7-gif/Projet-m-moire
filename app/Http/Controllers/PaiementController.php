<?php
namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Factures;
use Illuminate\Http\Request;
use App\Models\Client;

class PaiementController extends Controller
{
public function index()
{
    $paiements = Paiement::with('client')->latest()->get();
    $clients = Client::all(); //

    return view('paiements.index', compact('paiements', 'clients'));
}

public function store(Request $request)
{
    $request->validate([
        'client_id' => 'required|exists:clients,id',
        'montant' => 'required|numeric|min:1',
    ]);

    Paiement::create([
        'client_id' => $request->client_id,
        'montant' => $request->montant,
    ]);

    return back()->with('success', 'Paiement enregistré avec succès');
}
public function create()
{
    $factures = Factures::all();

    return view('paiements.create', compact('factures'));
}
}

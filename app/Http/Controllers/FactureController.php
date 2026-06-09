<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Factures;
use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Reservation;

class FactureController extends Controller
{
    // LISTE FACTURES
    public function index()
    {
        $factures = Factures::with('client', 'paiements')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('factures.index', compact('factures'));
    }

    // FORM CREATE
   public function create()
{
    $clients = Client::all();
    $reservations = Reservation::all();

    return view('factures.create', compact('clients', 'reservations'));
}
    // STORE FACTURE
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'montant' => 'required|numeric|min:0',
        ]);

        Factures::create([
            'client_id' => $request->client_id,
            'montant' => $request->montant,
            'montant_paye' => 0,
            'reste' => $request->montant,
            'statut' => 'impayée',
            'created_by' => Auth::id(),
        ]);

        return redirect('/factures')->with('success', 'Facture créée avec succès');
    }

    // SHOW FACTURE
    public function show($id)
    {
        $facture = Factures::with('client', 'paiements')->findOrFail($id);

        return view('factures.show', compact('facture'));
    }

    // DELETE FACTURE
    public function destroy($id)
    {
        $facture = Factures::findOrFail($id);
        $facture->delete();

        return back()->with('success', 'Facture supprimée');
    }

    // MARQUER PAYÉE
    public function payer($id)
    {
        $facture = Factures::findOrFail($id);

        $facture->montant_paye = $facture->montant;
        $facture->reste = 0;
        $facture->statut = 'payée';

        $facture->save();

        return back()->with('success', 'Facture payée');
    }

    // PDF FACTURE
    public function exportPdf($id)
    {
        $facture = Factures::with('client', 'paiements')->findOrFail($id);

        $pdf = Pdf::loadView('factures.pdf', compact('facture'));

        return $pdf->download('facture_'.$facture->id.'.pdf');
    }
}

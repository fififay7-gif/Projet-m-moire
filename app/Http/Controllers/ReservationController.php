<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Client;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('client')->latest()->get();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('reservations.create', compact('clients'));
    }

  public function store(Request $request)
{
    // 1. On valide uniquement les autres champs reçus (comme le client, etc.)
    $request->validate([
        'client_id' => 'required|exists:clients,id',
        // Plus besoin de valider 'date_reservation' puisqu'elle n'est plus dans le formulaire
    ]);

    // 2. On crée la réservation en y ajoutant manuellement la date actuelle
    Reservation::create([
        'client_id' => $request->client_id,
        'date_reservation' => now(), // Génère automatiquement la date et l'heure courante (YYYY-MM-DD HH:MM:SS)
        // Ajoute ici tes autres champs si tu en as (ex: 'statut' => 'confirmé')
    ]);

    // 3. Redirection vers la liste avec un message de succès
    return redirect()->route('reservations.index')->with('success', 'Réservation enregistrée automatiquement !');
}

    

    public function updateStatus($id, $statut)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->statut = $statut;
        $reservation->save();

        return back()->with('success', 'Statut mis à jour');
    }

    public function destroy($id)
    {
        Reservation::findOrFail($id)->delete();
        return back()->with('success', 'Supprimée avec succès');
    }
}

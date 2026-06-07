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
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'type_service' => 'required|string',
            'date_reservation' => 'required|date',
        ]);

       Reservation::create([
    'client_id' => $request->client_id,
    'type_voyage' => $request->type_voyage,
    'date_reservation' => now(), // automatique 👍
    'date_voyage' => $request->date_voyage,
]);

        return redirect()->back()->with('success', 'Réservation ajoutée avec succès');
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

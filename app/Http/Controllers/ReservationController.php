<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class ReservationController extends Controller
{
    /**
     * 👥 AGENT DE COMPTOIR : Liste standard des réservations
     */
    public function index()
    {
        $reservations = Reservation::with('client')->latest()->get();
        $clients = Client::orderBy('nom')->get();

        return view('reservations.index', compact('reservations', 'clients'));
    }

    /**
     *  CHEF D'AGENCE : Espace de décision et de supervision
     */

public function chefIndex()
{
    // 1. On récupère toutes les réservations
    $reservations = Reservation::with('client')->orderBy('created_at', 'desc')->get();

    // 2. CORRECTION : On récupère aussi tous les clients pour le modal de modification
    $clients = Client::orderBy('nom')->get();

    // 3. On passe les DEUX variables à la vue du chef
    return view('chef_agence.reservations', compact('reservations', 'clients'));
}

    /**
     *  COMPTABLE : Liste en lecture seule pour suivi financier
     */
    public function comptableIndex()
    {
        $reservations = Reservation::with('client')->latest()->get();
        return view('comptable.reservations', compact('reservations'));
    }

    /**
     * 👥 AGENT : Formulaire de création
     */
    public function create()
    {
        $clients = Client::orderBy('nom')->get();
        return view('reservations.create', compact('clients'));
    }

    /**
     * 👥 AGENT : Enregistrement d'une nouvelle réservation
     */
    public function store(Request $request)
{
    $request->validate([
        'client_id'   => 'required|exists:clients,id',
        'destination' => 'required|string|max:255',
        'classe'      => 'required|string|max:255',
        'description' => 'nullable|string',
        // Ajoutez ces lignes pour valider les nouveaux champs
        'montant'       => 'nullable|numeric',
        'mode_paiement' => 'nullable|string|max:255',
    ]);

    $code = 'RES-' . date('Y') . '-' . strtoupper(Str::random(4));

    Reservation::create([
        'code'             => $code,
        'client_id'        => $request->client_id,
        'destination'      => $request->destination,
        'classe'           => $request->classe,
        'description'      => $request->description,
        'statut'           => 'en_attente',
        'date_reservation' => now()->format('Y-m-d H:i:s'),

        // C'EST ICI QUE CELA MANQUAIT :
        'montant'          => $request->montant ?? 0,
        'mode_paiement'    => $request->mode_paiement,
    ]);

    return redirect()->route('reservations.index')->with('success', 'Réservation ' . $code . ' enregistrée avec succès !');
}

    /**
     *  AGENT : Formulaire d'édition
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $clients = Client::orderBy('nom')->get();

        if (view()->exists('reservations.edit')) {
            return view('reservations.edit', compact('reservation', 'clients'));
        }

        return view('reservations.create', compact('reservation', 'clients'));
    }

    /**
     *  AGENT : Traitement de la modification (Validé et Complété)
     */
    // Pour l'Agent (Modification complète)
public function update(Request $request, $id)
{
    $reservation = Reservation::findOrFail($id);

    $request->validate([
        'client_id' => 'required',
        'type_service' => 'required',
        'destination' => 'required',
        'classe' => 'required',
        'montant' => 'required|numeric',
        'mode_paiement' => 'required',
    ]);

    $reservation->update($request->all());

    return back()->with('success', 'Réservation modifiée avec succès.');
}

// Pour le Chef d'Agence (Modification du Statut uniquement)
public function updateStatut(Request $request, $id)
{
    $reservation = Reservation::findOrFail($id);

    // On valide que le statut est bien soit 'valider', soit 'rejeter'
    $request->validate([
        'statut' => 'required|in:valider,rejeter',
    ]);

    $reservation->update([
        'statut' => $request->statut
    ]);

    return back()->with('success', 'La réservation a été ' . $request->statut . 'e avec succès.');
}
    /**
     *  CHEF D'AGENCE : Validation
     */
    public function validateReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->statut = 'validee';
        $reservation->motif_rejet = null;
        $reservation->save();

        return redirect()->back()->with('success', 'La réservation ' . ($reservation->code ?? '#' . $reservation->id) . ' a été validée !');
    }

    /**
     *  CHEF D'AGENCE : Rejet
     */
    public function rejectReservation(Request $request, $id)
    {
        $request->validate([
            'motif_rejet' => 'required|string|max:255',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->statut = 'rejetee';
        $reservation->motif_rejet = $request->motif_rejet;
        $reservation->save();

        return redirect()->back()->with('success', 'La réservation ' . ($reservation->code ?? '#' . $reservation->id) . ' a été rejetée.');
    }

    /**
     *  CHEF D'AGENCE : Remise en attente
     */
    public function resetStatus($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->motif_rejet = null;
        $reservation->statut = 'en_attente';
        $reservation->save();

        return redirect()->back()->with('success', 'La réservation a été remise en attente.');
    }

    /**
     * 👥 AGENT : Suppression définitive
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'La réservation a été supprimée avec succès.');
    }

    /**
     *  CHEF D'AGENCE : Suppression
     */
    public function destroyReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->back()->with('success', 'La réservation a été supprimée définitivement.');
    }

    /**
     * Patch de sécurité pour intercepter les conflits d'URLs
     */
    public function updateStatus($id, $statut = null)
    {
        if ($statut === 'edit') {
            return $this->edit($id);
        }
        abort(404);
    }

    public function traiterPaiement(Request $request, $id)
{
    $request->validate([
        'montant' => 'required|numeric|min:0',
        'mode_paiement' => 'required|string',
    ]);

    $reservation = Reservation::findOrFail($id);

    // On met à jour les données financières et on valide
    $reservation->update([
        'montant' => $request->montant,
        'mode_paiement' => $request->mode_paiement,
        'statut' => 'validee' // ou 'valide' selon ton énumération
    ]);

    return redirect()->back()->with('success', 'La réservation ' . $reservation->code . ' a été payée et validée avec succès !');
}
 // Assurez-vous que c'est bien présent en haut

public function valider($id)
{
    $reservation = Reservation::findOrFail($id);
    $reservation->statut = 'Validée';
    $reservation->save();

    return back()->with('success', 'Réservation validée avec succès !');
}

public function rejeter(Request $request, $id)
{
    if (!Auth::check() || Auth::user()->role !== 'chef_agence') {
        abort(403, 'Action non autorisée.');
    }
}

public function dashboard()
{
    // Calcul du chiffre d'affaires total et du volume de billets
    $totalCA = Reservation::where('statut', 'validee')->sum('montant');
    $totalBillets = Reservation::where('statut', 'validee')->count();

    // Statistiques par mois pour le graphique (Exemple pour 2026)
    $statsMensuelles = Reservation::where('statut', 'validee')
        ->whereYear('created_at', 2026)
        ->selectRaw('MONTH(created_at) as mois, SUM(montant) as ca, COUNT(*) as volume')
        ->groupBy('mois')
        ->get();

    return view('chef_agence.dashboard', compact('totalCA', 'totalBillets', 'statsMensuelles'));
}
public function reservations()
    {
        // Récupère toutes les réservations
        $reservations = Reservation::all();

        // Retourne la vue dans votre dossier dashboards/comptable
        return view('comptable.reservations', compact('reservations'));
    }
}

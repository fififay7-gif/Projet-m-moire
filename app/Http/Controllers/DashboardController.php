<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Paiement;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Versement;
use App\Models\Client;
class DashboardController extends Controller
{
    /**
     * Point d'entrée unique (/dashboard) qui redirige l'utilisateur
     * vers le bon tableau de bord selon son rôle au sein d'EMS Voyage.
     */
    public function index()
{
    // 1. Vérification de sécurité
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // 2. Récupération du profil nettoyé et converti en minuscules
    // Cela supprime les espaces au début/fin et ignore les majuscules (ex: "Chef d'agence" devient "chef d'agence")
    $role = strtolower(trim(Auth::user()->profil));

    // 3. Redirection basée sur des conditions souples
    if (str_contains($role, 'admin')) {
        return redirect()->route('admin.dashboard');
    }

    // Si le rôle contient "chef" ou "agence", on l'envoie direct au bon endroit
    if (str_contains($role, 'chef') || str_contains($role, 'agence')) {
        return redirect()->route('chef.dashboard');
    }

    if (str_contains($role, 'comptable')) {
    return redirect()->route('comptable.dashboard'); // Correspond au name() de la route
}

    if (str_contains($role, 'comptoir') || str_contains($role, 'agent')) {
        return redirect()->route('comptoir.dashboard');
    }

    // 4. Sécurité si aucun rôle ne correspond
    Auth::logout();
    return abort(403, "Accès refusé. Rôle détecté : " . Auth::user()->profil);
}
    /**
     * Vue dédiée à l'Administrateur Système
     */

    public function storeReservation(Request $request)
    {
        Reservation::create($request->all());
        return redirect()->route('comptable.dashboard')->with('success', 'Réservation ajoutée !');
    }

    public function storePaiement(Request $request)
    {
        Paiement::create($request->all());
        return redirect()->route('comptable.dashboard')->with('success', 'Paiement enregistré !');
    }

    public function storeVersement(Request $request)
    {
        Versement::create($request->all());
        return redirect()->route('comptable.dashboard')->with('success', 'Versement ajouté !');
    }



    public function adminIndex()
{
    // 1. Tes compteurs du haut
    $totalUsers = User::count();
    $activeUsers = User::where('statut', 'actif')->count();

    // 2. Récupération des inscriptions groupées par mois (pour les 6 derniers mois)
    // Ici, on récupère le nombre total et le nombre d'actifs par mois de création
    $monthlyStats = User::selectRaw("
            DATE_FORMAT(created_at, '%b') as month,
            COUNT(id) as total,
            SUM(CASE WHEN statut = 'actif' THEN 1 ELSE 0 END) as active,
            MONTH(created_at) as month_num
        ")
        ->groupBy('month', 'month_num')
        ->orderBy('month_num', 'asc')
        ->take(6)
        ->get();

    // Préparation des tableaux pour JavaScript
    $months = $monthlyStats->pluck('month')->toArray();
    $totalData = $monthlyStats->pluck('total')->toArray();
    $activeData = $monthlyStats->pluck('active')->toArray();

    // Si la base est vide, on met des valeurs par défaut pour éviter que le graphique soit blanc
    if(empty($months)) {
        $months = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'];
        $totalData = [0, 0, 0, 0, 0, $totalUsers];
        $activeData = [0, 0, 0, 0, 0, $activeUsers];
    }

    return view('dashboards.admin', compact('totalUsers', 'activeUsers', 'months', 'totalData', 'activeData'));
}

    /**
     * Vue dédiée au Chef d'agence
     */
    public function chefIndex()
{
    // Statistiques globales
    $totalClients = Client::count();
    $totalReservations = Reservation::count();
    $totalPaiements = Paiement::count();
    $caAnnuel = Paiement::sum('montant'); // Ou votre logique de CA
$statsAnnuelles = Paiement::select(
    DB::raw('YEAR(created_at) as annee'),
    DB::raw('SUM(montant) as ca')
)
->groupBy('annee')
->orderBy('annee', 'DESC')
->limit(3)
->pluck('ca', 'annee')
->toArray();

    $statsMensuelles = Paiement::select(
    DB::raw('MONTH(created_at) as mois'),
    DB::raw('SUM(montant) as ca')
)
->whereYear('created_at', date('Y'))
->groupBy('mois')
->pluck('ca', 'mois')
->toArray();
    return view('dashboards.chef', compact('totalClients', 'totalReservations', 'totalPaiements', 'caAnnuel', 'statsMensuelles', 'statsAnnuelles'));
}
    /**
     * Vue dédiée au Comptable
     */
   public function comptableIndex()
{
    // On récupère les données une seule fois
    $data = [
        'totalReservations' => Reservation::count(),
        'versementsMensuels' => Versement::whereMonth('created_at', now()->month)
                                         ->whereYear('created_at', now()->year)
                                         ->count(),
        'totalPaiements' => Paiement::count(),
    ];

    // On retourne la vue avec le tableau $data
    return view('comptable.dashboard', $data);
}

       /**
     * Vue dédiée à l'Agent de comptoir
     */
    public function comptoirIndex()
    {
          $nombreClients = Client::count();
        $nombreReservations = Reservation::count();

        return view('dashboards.comptoir', compact('nombreClients', 'nombreReservations'));
    }
}

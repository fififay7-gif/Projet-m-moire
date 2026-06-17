<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Afficher les utilisateurs
     */
    public function index()
{
    $user = Auth::user();

    // On nettoie et on force en minuscules pour éviter les surprises
    $userProfil = $user ? strtolower(trim($user->profil)) : '';

    // CORRECTION ICI : On accepte "admin" OU "administrateur"
    if ($userProfil !== 'admin' && $userProfil !== 'administrateur') {
        abort(403, "ACCÈS INTERDIT : RÉSERVÉ À L'ADMINISTRATEUR SYSTÈME.");
    }

    // Reste de ton code (ex: $users = User::all(); return view(...);)
    $users = User::all();
    return view('users.index', compact('users')); // Écrit selon ton projet
} /**
     * Ajouter un utilisateur
     */
    public function store(Request $request)
{
    // 1. On ne valide plus le statut ici
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|string|email|max:255|unique:users',
        'password'   => 'required|string|min:6',
        'profil'     => 'required|string',
        'telephone'  => 'nullable|string',
        'adresse'    => 'nullable|string',
    ]);

    // 2. On injecte 'actif' automatiquement à la création
    User::create([
        'first_name' => $request->first_name,
        'last_name'  => $request->last_name,
        'email'      => $request->email,
        'password'   => bcrypt($request->password),
        'telephone'  => $request->telephone,
        'adresse'    => $request->adresse,
        'profil'     => $request->profil,
        'statut'     => 'actif',
    ]);

    return back()->with('success', 'Utilisateur créé avec succès et activé par défaut !');
}

    /**
     * Supprimer utilisateur
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect('/users')->with('success', 'Utilisateur supprimé avec succès');
    }

    public function toggleStatus($id)
{

    $user = User::findOrFail($id);

    // 2. Si le statut est actif, on le rend inactif. Sinon, on le rend actif.
    if ($user->statut == 'actif') {
        $user->statut = 'inactif';
        $message = "Le compte de {$user->first_name} a été désactivé (Inactif).";
    } else {
        $user->statut = 'actif';
        $message = "Le compte de {$user->first_name} a été réactivé (Actif).";
    }

    // 3. On sauvegarde le changement dans phpMyAdmin
    $user->save();

    // 4. On revient sur la page avec le message de succès
    return back()->with('success', $message);
}
public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Validation stricte (en excluant l'ID actuel pour l'email unique)
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|string|email|max:255|unique:users,email,'.$user->id,
        'profil'     => 'required|string',
        'telephone'  => 'nullable|string',
        'adresse'    => 'nullable|string',
    ]);

    // Mise à jour des informations
    $user->update([
        'first_name' => $request->first_name,
        'last_name'  => $request->last_name,
        'email'      => $request->email,
        'telephone'  => $request->telephone,
        'adresse'    => $request->adresse,
        'profil'     => $request->profil,
    ]);

    // Redirection avec le message flash que SweetAlert2 va attraper
    return back()->with('success', "Les modifications de {$user->first_name} ont été enregistrées !");
}
}

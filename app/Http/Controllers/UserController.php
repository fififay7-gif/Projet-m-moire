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
        // Utilisation propre de la Facade Auth (Pense à vérifier que "use Illuminate\Support\Facades\Auth;" est bien en haut du fichier)
        if (\Illuminate\Support\Facades\Auth::user()->role !== 'administrateur') {
            return abort(403, 'Accès interdit : Réservé à l\'administrateur système.');
        }

        $users = User::all();
        return view('users.index', compact('users'));
    } /**
     * Ajouter un utilisateur
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect('/users')->with('success', 'Utilisateur ajouté avec succès');
    }

    /**
     * Supprimer utilisateur
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect('/users')->with('success', 'Utilisateur supprimé avec succès');
    }
}

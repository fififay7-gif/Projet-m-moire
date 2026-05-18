<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Afficher les utilisateurs
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
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

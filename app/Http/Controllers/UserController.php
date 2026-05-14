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
     * Supprimer utilisateur
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect('/users')
            ->with('success', 'Utilisateur supprimé avec succès');
    }
}

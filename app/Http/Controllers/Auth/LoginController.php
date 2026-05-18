<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * Connexion utilisateur
     */
    public function login(Request $request)
    {

        // VALIDATION
        $request->validate([

            'email' => 'required|email',

            'password' => 'required'

        ]);

        // TENTER CONNEXION
        if (Auth::attempt($request->only('email', 'password'))) {

            // REGENERER SESSION
            $request->session()->regenerate();

            // USER CONNECTÉ
            $user = Auth::user();



            // FORCER CHANGEMENT PASSWORD
            if ($user->must_change_password == true) {

                return redirect('/change-password');
            }

            // ADMIN
            if ($user->role === 'admin') {

                return redirect('/admin/dashboard');

            }

            // USER
             // CHANGER PASSWORD
    if ($user->must_change_password) {

        return redirect('/change-password');

    }

    // ADMIN
    if ($user->role === 'admin') {

        return redirect('/admin/dashboard');

    }

    // USER
    return redirect('/user/dashboard');

        }

        // ERREUR LOGIN
        return back()->withErrors([

            'email' => 'Email ou mot de passe incorrect'

        ]);

    }

    /**
     * Déconnexion
     */
    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');

    }

}

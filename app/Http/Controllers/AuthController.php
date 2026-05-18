<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validation
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Tentative de connexion
        if (Auth::attempt($credentials)) {

            // Régénérer session (sécurité)
            $request->session()->regenerate();

            // Redirection vers dashboard
            return redirect()->route('dashboard');
        }
 $user = Auth::user();

        if ($user->must_change_password == 1) {
    return redirect('/changer-mot-de-passe');
}

        // Si erreur
        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect'
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Détruire session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //  Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('login');
    }

    //  Traiter la connexion
    public function login(Request $request)
    {
        //  Validation des champs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        //  Tentative de connexion
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            //  Sécuriser la session
            $request->session()->regenerate();

            //  Redirection selon rôle
           if (Auth::user()->role === 'admin') {

    return redirect('/admin/dashboard');

} else {

    return redirect('/user/dashboard');
}
        }

        //  Échec connexion
        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect'
        ])->withInput();
    }

    //  Dashboard (protégé)
    public function dashboard()
    {
        return view('dashboard');
    }

    //  Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();

        //  Sécuriser la session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

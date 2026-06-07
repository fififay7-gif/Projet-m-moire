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
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (!Auth::attempt($credentials)) {

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect'
        ])->withInput();
    }

    $request->session()->regenerate();

    $user = Auth::user();

    // Première connexion
    if ($user->must_change_password == 1) {
        return redirect('/change-password');
    }

    // Redirection selon le rôle
    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    }

    return redirect('/user/dashboard');
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

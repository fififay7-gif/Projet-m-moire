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
    // 1. Validation des champs
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // 2. Tentative de connexion
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        
        // On redirige FORCÉMENT vers '/dashboard' pour que le tri des rôles se fasse !
        return redirect('/dashboard');
    }

    // Si ça échoue
    return back()->withErrors([
        'email' => 'Les identifiants ne correspondent pas.',
    ])->onlyInput('email');
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

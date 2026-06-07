<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'chef_agence') {
                return redirect('/chef/dashboard');
            }

            if ($user->role === 'comptable') {
                return redirect('/comptable/dashboard');
            }

            return redirect('/agent/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect',
        ]);
    }
}

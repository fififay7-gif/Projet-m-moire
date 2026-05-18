<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            $request->session()->regenerate();

            $user = Auth::user();

            //  FORCER CHANGEMENT DE MOT DE PASSE
            if ($user->must_change_password) {
                return redirect('/changer-mot-de-passe');
            }

            //  REDIRECTION PAR RÔLE
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            return redirect('/user/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect'
        ])->withInput();
    }
}

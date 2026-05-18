<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * Afficher page modifier mot de passe
     */
    public function edit()
    {
        return view('modifier_password');
    }

    /**
     * Modifier mot de passe
     */
    public function updatePassword(Request $request)
    {

        // VALIDATION
        $request->validate([

            'ancien_password' => 'required',

            'password' => 'required|min:6|confirmed'

        ]);

        // USER CONNECTE
       /** @var \App\Models\User $user */
$user = Auth::user();

        // VERIFIER ANCIEN PASSWORD
        if(!Hash::check($request->ancien_password, $user->password))
        {
            return back()->with('error', 'Ancien mot de passe incorrect');
        }

        // MODIFIER PASSWORD
        $user->password = Hash::make($request->password);
         $user->must_change_password = false;

        $user->save();

        return back()->with('success', 'Mot de passe modifié avec succès');

    }
}
/** @var \App\Models\User $user */
$user = Auth::user();

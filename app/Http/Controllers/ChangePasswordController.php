<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        return view('modifier_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'ancien_password' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);
         /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!Hash::check($request->ancien_password, $user->password)) {
            return back()->with('error', 'Ancien mot de passe incorrect');
        }

        $user->password = Hash::make($request->password);
        $user->must_change_password = 0;
        $user->save();

        return redirect()->route('dashboard');
    }
}

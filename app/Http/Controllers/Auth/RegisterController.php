<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $this->create($request->all());

        return redirect()->route('dashboard')
            ->with('success', 'Utilisateur créé avec succès !');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
        ]);
    }

    protected function create(array $data)
{
    return User::create([

        'name' => $data['name'],

        'email' => $data['email'],

        'role' => $data['role'],

        // MOT DE PASSE PAR DÉFAUT
        'password' => Hash::make('password123'),

        // OBLIGER À CHANGER
        'must_change_password' => true,

    ]);
}
}

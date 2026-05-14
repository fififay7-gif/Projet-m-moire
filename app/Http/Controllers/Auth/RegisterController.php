<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Affiche le formulaire d'inscription.
     */
    public function show()
    {
        return view('auth.register'); // Assurez-vous que ce fichier existe
    }

    /**
     * Traite l'inscription d'un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        // 1. Validation
        $data = $request->all();
        $validator = $this->validator($data);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // 2. Création de l'utilisateur
        $user = $this->create($data);

        // 3. Redirection (vers le dashboard par exemple)
        return redirect()->route('dashboard')->with('success', 'Utilisateur créé avec succès !');
    }

    /**
     * Validation des données.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Création de l'utilisateur.
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    
}

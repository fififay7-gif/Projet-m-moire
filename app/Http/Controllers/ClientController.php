<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * 👥 DIRECTION : AGENT DE COMPTOIR
     * Affiche la liste complète avec les options d'écriture (Ajouter, Modifier, Supprimer)
     */
    public function index()
    {
        $clients = Client::latest()->get();

        // Renvoie vers le dossier classique : resources/views/clients/index.blade.php
        return view('clients.index', compact('clients'));
    }

    /**
     * 👑 DIRECTION : CHEF D'AGENCE
     * Affiche la liste en LECTURE SEULE sans aucun bouton d'action
     */
    public function chefIndex()
    {
        $clients = Client::latest()->get();

        //  Renvoie vers ton NOUVEAU dossier : resources/views/chef/clients.blade.php
        return view('chef.clients', compact('clients'));
    }

    /**
     * Formulaire de création (Agent uniquement)
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Enregistrement du client (Agent uniquement)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string',
        ]);

        Client::create($request->all());

        return redirect('/clients')->with('success', 'Client enregistré par l\'agent.');
    }

    /**
     * Formulaire de modification (Agent uniquement)
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    /**
     * Sauvegarde de la modification (Agent uniquement)
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->update($request->all());

        return redirect('/clients')->with('success', 'Client mis à jour.');
    }

    /**
     * Suppression (Agent uniquement)
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect('/clients')->with('success', 'Client supprimé.');
    }
}

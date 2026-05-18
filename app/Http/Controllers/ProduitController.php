<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Liste des produits
     */
    public function index()
    {
        $produits = Produit::all();

        $nombreProduits = Produit::count();

        return view('produits.index', compact('produits', 'nombreProduits'));
    }

    /**
     * Formulaire ajout produit
     */
    public function create()
    {
        return view('produits.create');
    }

    /**
     * Enregistrer produit
     */
    public function store(Request $request)
{
    Produit::create([
        'nom' => $request->nom,

        'categorie' => $request->categorie,
        'quantite' => $request->quantite,

        'agence' => $request->agence,
    ]);


       
        return redirect('/produits')
                ->with('success', 'Produit ajouté avec succès');
    }
}

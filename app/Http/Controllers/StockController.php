<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class StockController extends Controller
{
    /**
     * Afficher stock
     */
    public function index()
    {
        $produits = Produit::all();

        return view('stocks.index', compact('produits'));
    }

    /**
     * Modifier quantité
     */
    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);

        $produit->quantite = $request->quantite;

        $produit->save();

        return redirect('/stocks')
            ->with('success', 'Stock modifié avec succès');
    }
    public function destroy($id)
{
    $produit = Produit::find($id);

    if (!$produit) {
        return redirect('/stocks')->with('error', 'Produit introuvable');
    }

    $produit->delete();

    return redirect('/stocks')
        ->with('success', 'Produit supprimé avec succès');
}
}

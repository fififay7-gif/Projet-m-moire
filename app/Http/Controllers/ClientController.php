<?php
namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->get();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'telephone' => 'required'
        ]);

        Client::create($request->all());

        return redirect('/clients')->with('success', 'Client ajouté avec succès');
    }

    public function destroy($id)
    {
        Client::findOrFail($id)->delete();

        return back()->with('success', 'Client supprimé');
    }
}

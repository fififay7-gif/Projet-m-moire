<?php

namespace App\Http\Controllers;

use App\Models\Versement;
use App\Models\BordereauEncaissement;
use Illuminate\Http\Request;

class VersementController extends Controller
{
    public function index()
    {
        $versements = Versement::all();

        return view('versements.index', compact('versements'));
    }

    public function create()
    {
        $bordereaux = BordereauEncaissement::all();

        return view('versements.create',
            compact('bordereaux'));
    }

    public function store(Request $request)
    {
        Versement::create($request->all());

        return redirect()->route('versements.index');
    }
}

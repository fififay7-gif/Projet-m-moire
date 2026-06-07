<?php

namespace App\Http\Controllers;

use App\Models\BordereauEncaissement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BordereauController extends Controller
{
    public function index()
    {
        $bordereaux = BordereauEncaissement::latest()->get();

        return view('bordereaux.index', compact('bordereaux'));
    }

    public function create()
    {
        return view('bordereaux.create');
    }

    public function store(Request $request)
    {
        BordereauEncaissement::create([
            'user_id' => Auth::id(),
            'numero_bordereau' => 'BORD-' . time(),
            'montant_total' => $request->montant_total,
            'date_bordereau' => $request->date_bordereau
        ]);

        return redirect()->route('bordereaux.index');
    }
}

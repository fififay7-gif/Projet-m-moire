<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MouvementController extends Controller
{
    /**
     * Afficher la page des mouvements
     */
    public function index()
    {
        return view('mouvements.index');
    }
}

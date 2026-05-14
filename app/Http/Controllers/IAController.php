<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IAController extends Controller
{
    /**
     * Afficher la page IA
     */
    public function index()
    {
        return view('ia.index');
    }
}

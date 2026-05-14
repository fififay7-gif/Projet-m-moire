<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlerteController extends Controller
{
    /**
     * Afficher la page des alertes stock
     */
    public function index()
    {
        return view('alertes.index');
    }
}

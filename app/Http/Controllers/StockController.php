<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Afficher la page gestion du stock
     */
    public function index()
    {
        return view('stocks.index');
    }
}

@extends('layouts.app')

@section('content')

<style>

    .page-title{
        color:#1e3a8a;
        margin-bottom:25px;
    }

    .cards{
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
        gap:20px;
    }

    .card-box{
        background:white;
        padding:20px;
        border-radius:15px;
        box-shadow:0 5px 15px rgba(0,0,0,0.08);
    }

    .card-box h3{
        color:#1e3a8a;
        margin-bottom:10px;
    }

    .btn{
        display:inline-block;
        margin-top:15px;
        padding:10px 15px;
        background:#2563eb;
        color:white;
        text-decoration:none;
        border-radius:8px;
        transition:0.3s;
    }

    .btn:hover{
        background:#1e3a8a;
    }

    table{
        width:100%;
        border-collapse:collapse;
        margin-top:30px;
        background:white;
        border-radius:15px;
        overflow:hidden;
        box-shadow:0 5px 15px rgba(0,0,0,0.08);
    }

    table th{
        background:#1e3a8a;
        color:white;
        padding:15px;
    }

    table td{
        padding:15px;
        border-bottom:1px solid #ddd;
        text-align:center;
    }

    .entree{
        color:green;
        font-weight:bold;
    }

    .sortie{
        color:red;
        font-weight:bold;
    }

</style>

<h1 class="page-title">
     Gestion des Entrées / Sorties
</h1>

<!--  CARDS -->
<div class="cards">

    <div class="card-box">

        <h3> Entrées Stock</h3>

        <p>Ajouter des produits au stock.</p>

        <a href="#" class="btn">
            Nouvelle Entrée
        </a>

    </div>

    <div class="card-box">

        <h3> Sorties Stock</h3>

        <p>Retirer des produits du stock.</p>

        <a href="#" class="btn">
            Nouvelle Sortie
        </a>

    </div>

    <div class="card-box">

        <h3> Total Mouvements</h3>

        <p style="font-size:30px; color:#1e3a8a;">
            12
        </p>

    </div>

</div>

<!--  TABLE -->
<table>

    <thead>

        <tr>
            <th>Produit</th>
            <th>Type</th>
            <th>Quantité</th>
            <th>Date</th>
        </tr>

    </thead>

    <tbody>

        <tr>
            <td>Ordinateur HP</td>
            <td class="entree">Entrée</td>
            <td>10</td>
            <td>12/08/2025</td>
        </tr>

        <tr>
            <td>Clavier Logitech</td>
            <td class="sortie">Sortie</td>
            <td>2</td>
            <td>12/08/2025</td>
        </tr>

        <tr>
            <td>Souris Dell</td>
            <td class="entree">Entrée</td>
            <td>5</td>
            <td>11/08/2025</td>
        </tr>

    </tbody>

</table>

@endsection

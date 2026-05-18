@extends('layouts.app')

@section('content')

<style>

body{
    background:#f5f7fb;
}

/* TITLE */
.page-title{
    color:#1e3a8a;
    margin-bottom:25px;
    font-weight:bold;
}

/* CARDS GRID */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
}

/* CARD */
.card-box{
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.06);
    border-top:4px solid #2563eb;
    transition:0.3s;
}

.card-box:hover{
    transform:translateY(-5px);
}

.card-box h3{
    color:#1e3a8a;
    margin-bottom:10px;
    font-weight:bold;
}

.card-box p{
    color:#64748b;
}

/* BUTTON EMS */
.btn{
    display:inline-block;
    margin-top:15px;
    padding:10px 15px;
    background: linear-gradient(135deg,#2563eb,#1e3a8a);
    color:white;
    text-decoration:none;
    border-radius:10px;
    font-weight:bold;
    transition:0.3s;
}

.btn:hover{
    transform:scale(1.05);
}

/* TABLE CONTAINER */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:30px;
    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,0.06);
}

/* HEADER */
table th{
    background: linear-gradient(135deg,#1e3a8a,#2563eb);
    color:white;
    padding:15px;
    text-align:center;
}

/* ROWS */
table td{
    padding:15px;
    border-bottom:1px solid #eee;
    text-align:center;
}

/* HOVER ROW */
table tr:hover{
    background:#f0f4ff;
}

/* BADGES */
.entree{
    color:#16a34a;
    font-weight:bold;
    background:#dcfce7;
    padding:5px 10px;
    border-radius:8px;
}

.sortie{
    color:#dc2626;
    font-weight:bold;
    background:#fee2e2;
    padding:5px 10px;
    border-radius:8px;
}

</style>

<h1 class="page-title">
    Gestion des Entrées / Sorties EMS
</h1>

<!-- CARDS -->
<div class="cards">

    <div class="card-box">
        <h3> Entrées Stock</h3>
        <p>Ajouter des produits au stock.</p>
        <a href="#" class="btn">Nouvelle Entrée</a>
    </div>

    <div class="card-box">
        <h3> Sorties Stock</h3>
        <p>Retirer des produits du stock.</p>
        <a href="#" class="btn">Nouvelle Sortie</a>
    </div>

    <div class="card-box">
        <h3> Total Mouvements</h3>
        <p style="font-size:30px; color:#2563eb; font-weight:bold;">
            12
        </p>
    </div>

</div>

<!-- TABLE -->
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
            <td><span class="entree">Entrée</span></td>
            <td>10</td>
            <td>12/08/2025</td>
        </tr>

        <tr>
            <td>Clavier Logitech</td>
            <td><span class="sortie">Sortie</span></td>
            <td>2</td>
            <td>12/08/2025</td>
        </tr>

        <tr>
            <td>Souris Dell</td>
            <td><span class="entree">Entrée</span></td>
            <td>5</td>
            <td>11/08/2025</td>
        </tr>

    </tbody>

</table>

@endsection

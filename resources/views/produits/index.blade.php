@extends('layouts.app')

@section('content')

<style>
    .page-title{
        color:#1e3a8a;
        margin-bottom:20px;
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

    .btn{
        display:inline-block;
        margin-top:15px;
        padding:10px 15px;
        background:#2563eb;
        color:white;
        text-decoration:none;
        border-radius:8px;
    }

    .btn:hover{
        background:#1e3a8a;
    }
</style>

<h1 class="page-title"> Gestion des Produits</h1>

<div class="cards">

    <div class="card-box">

        <h3>Total Produits</h3>

        <p>42 produits enregistrés</p>

    </div>

    <div class="card-box">

        <h3>Ajouter Produit</h3>

        <p>Créer un nouveau produit</p>

        <a href="#" class="btn">
            Ajouter
        </a>

    </div>

    <div class="card-box">

        <h3>Consulter Stock</h3>

        <p>Voir tous les produits</p>

        <a href="#" class="btn">
            Voir
        </a>

    </div>

</div>

@endsection

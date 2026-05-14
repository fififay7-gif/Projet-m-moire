@extends('layouts.app')

@section('content')

<style>
    body {
        background-color: #f0f4ff;
    }

    .title {
        color: #1e3a8a;
        margin-bottom: 20px;
    }

    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
    }

    .card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        text-align: center;
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card h3 {
        color: #1e3a8a;
        margin-bottom: 10px;
    }

    .card p {
        color: #3b82f6;
    }

    .stats {
        font-size: 30px;
        font-weight: bold;
        color: #1e3a8a;
    }

    .section {
        margin-top: 30px;
    }

    .section h2 {
        color: #1e3a8a;
        margin-bottom: 15px;
    }

    .info-box {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .action-btn {
        display: inline-block;
        margin-top: 10px;
        padding: 10px 15px;
        background: #2563eb;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        transition: 0.3s;
    }

    .action-btn:hover {
        background: #1e3a8a;
    }
</style>

<h1 class="title"> Dashboard Administrateur</h1>

<!--  STATISTIQUES -->
<div class="cards">

    <div class="card">
        <p>Total Produits</p>
        <div class="stats">42</div>
    </div>

    <div class="card">
        <p>Stock Faible</p>
        <div class="stats">5</div>
    </div>

    <div class="card">
        <p>Mouvements Aujourd’hui</p>
        <div class="stats">12</div>
    </div>

    <div class="card">
        <p>Utilisateurs</p>
        <div class="stats">3</div>
    </div>

</div>

<!--  INFORMATIONS -->
<div class="section">

    <h2>Informations Administrateur</h2>

    <div class="info-box">

        <p><strong>Nom :</strong> {{ Auth::user()->name }}</p>

        <p><strong>Email :</strong> {{ Auth::user()->email }}</p>

        <p><strong>Rôle :</strong> {{ Auth::user()->role }}</p>

        <p><strong>Date inscription :</strong>
            {{ Auth::user()->created_at->format('d/m/Y') }}
        </p>

    </div>

</div>

<!--  ACTIONS -->
<div class="section">

    <h2>Actions Rapides</h2>

    <div class="cards">

        <div class="card">
            <h3> Utilisateurs</h3>
            <p>Gérer les utilisateurs</p>

            <a href="/register" class="action-btn">
                Ajouter
            </a>
        </div>

        <div class="card">
            <h3> Produits</h3>
            <p>Ajouter et modifier produits</p>

            <a href="#" class="action-btn">
                Accéder
            </a>
        </div>

        <div class="card">
            <h3> Mouvements</h3>
            <p>Entrées / sorties stock</p>

            <a href="#" class="action-btn">
                Voir
            </a>
        </div>
        <div class="cards">

        <div class="card">
            <h3> Consulter Stock</h3>
            <p>Voir les produits disponibles</p>

            <a href="#" class="action-btn">
                Voir
            </a>
        </div>

    </div>

</div>

@endsection

@extends('layouts.app')

@section('content')

<style>
    body {
        background-color: #f5f7fb;
    }

    .title {
        color: #1e3a8a;
        margin-bottom: 25px;
        font-weight: bold;
    }

    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
    }

    .card {
        background: white;
        padding: 20px;
        border-radius: 14px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        text-align: center;
        transition: 0.3s ease;
        border-top: 4px solid #1e3a8a;
    }

    .card:hover {
        transform: translateY(-6px);
    }

    .card h3 {
        color: #1e3a8a;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .card p {
        color: #64748b;
    }

    .stats {
        font-size: 32px;
        font-weight: bold;
        color: #2563eb;
    }

    .alert-card {
        border-top: 4px solid #f97316;
    }

    .alert-card .stats {
        color: #f97316;
    }

    .section {
        margin-top: 35px;
    }

    .section h2 {
        color: #1e3a8a;
        margin-bottom: 15px;
    }

    .action-btn {
        display: inline-block;
        margin-top: 12px;
        padding: 10px 15px;
        background: #f97316;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
    }

    .action-btn:hover {
        background: #ea580c;
    }
</style>

<h1 class="title">Dashboard Utilisateur EMS</h1>

<!-- STATS -->
<div class="cards">

    <div class="card">
        <p>Produits Disponibles</p>
        <div class="stats">{{ $totalProduits }}</div>
    </div>

    <div class="card alert-card">
        <p>Alertes Stock</p>
        <div class="stats">{{ $stocksFaibles }}</div>
    </div>

</div>

<!-- ACTIONS -->
<div class="section">

    <h2>Actions Disponibles</h2>

    <div class="cards">

        <div class="card">
            <h3>Consulter Stock</h3>
            <p>Voir les produits disponibles</p>
            <a href="/stocks" class="action-btn">Voir</a>
        </div>

        <div class="card alert-card">
            <h3>Alertes</h3>
            <p>Produits avec stock faible</p>
            <a href="/alertes" class="action-btn">Consulter</a>
        </div>

    </div>

</div>

@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="color: #1e3a8a; font-weight: bold;">📊 Tableau de Bord - Chef d'Agence</h1>
        <span class="badge bg-primary fs-6">EMS Voyage : Administration</span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-white p-3" style="border-left: 5px solid #2563eb !important;">
                <h6 class="text-muted text-uppercase small font-weight-bold">Chiffre d'Affaires Mensuel</h6>
                <h3 class="text-dark font-weight-bold mt-2">-- FCFA</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-white p-3" style="border-left: 5px solid #10b981 !important;">
                <h6 class="text-muted text-uppercase small font-weight-bold">Billets Vendus</h6>
                <h3 class="text-dark font-weight-bold mt-2">0</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-white p-3" style="border-left: 5px solid #f59e0b !important;">
                <h6 class="text-muted text-uppercase small font-weight-bold">Total Employés</h6>
                <h3 class="text-dark font-weight-bold mt-2">Gestion Équipe</h3>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 p-4 bg-white">
        <h4 class="mb-3" style="color: #1e3a8a;"> Actions de Supervision</h4>
        <div class="d-flex gap-2 flex-wrap">
            <a href="/users" class="btn btn-outline-primary px-4 py-2 fw-bold" style="border-radius: 10px;">
                 Gérer le personnel
            </a>
            <button class="btn btn-outline-dark px-4 py-2 fw-bold" style="border-radius: 10px;">
                 Rappels & Statistiques IA
            </button>
        </div>
    </div>
</div>
@endsection

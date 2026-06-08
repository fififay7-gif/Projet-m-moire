@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="color: #166534; font-weight: bold;">Espace Comptabilité</h1>
        <span class="badge bg-success fs-6">EMS Voyage : Finances</span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 bg-white p-3" style="border-left: 5px solid #10b981 !important;">
                <h6 class="text-muted text-uppercase small font-weight-bold">Recettes à valider</h6>
                <h3 class="text-success font-weight-bold mt-2">En attente</h3>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 bg-white p-3" style="border-left: 5px solid #ef4444 !important;">
                <h6 class="text-muted text-uppercase small font-weight-bold">Dépenses de l'Agence</h6>
                <h3 class="text-dark font-weight-bold mt-2">0 FCFA</h3>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 p-4 bg-white">
        <h4 class="mb-3" style="color: #166534;"> Opérations Financières</h4>
        <div class="d-flex gap-2 flex-wrap">
            <button class="btn btn-outline-success px-4 py-2 fw-bold" style="border-radius: 10px;">
                 Journal des caisses
            </button>
            <button class="btn btn-outline-secondary px-4 py-2 fw-bold" style="border-radius: 10px;">
                Générer bilans financiers
            </button>
        </div>
    </div>
</div>
@endsection

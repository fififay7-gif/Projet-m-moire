@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="color: #ea580c; font-weight: bold;"> Guichet & Billetterie</h1>
        <span class="badge bg-warning text-dark fs-6">EMS Voyage : Opérations</span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 bg-white p-3" style="border-left: 5px solid #f97316 !important;">
                <h6 class="text-muted text-uppercase small font-weight-bold">Mes ventes du jour</h6>
                <h3 class="text-dark font-weight-bold mt-2">0 Billet</h3>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 bg-white p-3" style="border-left: 5px solid #6366f1 !important;">
                <h6 class="text-muted text-uppercase small font-weight-bold">Dernière transaction</h6>
                <h3 class="text-muted font-weight-bold mt-2" style="font-size: 16px;">Aucune opération effectuée</h3>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 p-4 bg-white">
        <h4 class="mb-3" style="color: #ea580c;">⚡ Opérations de Vente</h4>
        <div class="d-flex gap-2 flex-wrap">
            <button class="btn btn-outline-warning text-dark px-4 py-2 fw-bold" style="border-radius: 10px;">
                 Nouvelle Vente / Réservation
            </button>
            <button class="btn btn-outline-info px-4 py-2 fw-bold" style="border-radius: 10px;">
                 Rechercher un voyageur
            </button>
        </div>
    </div>
</div>
@endsection

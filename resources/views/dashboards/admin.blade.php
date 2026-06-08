@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="color: #dc2626; font-weight: bold;"> Administration Système</h1>
        <span class="badge bg-danger fs-6">EMS Voyage : Super Admin</span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 bg-white p-3" style="border-left: 5px solid #dc2626 !important;">
                <h6 class="text-muted text-uppercase small font-weight-bold">Gestion des Comptes</h6>
                <h3 class="text-dark font-weight-bold mt-2">Configuration Globale</h3>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 bg-white p-3" style="border-left: 5px solid #4b5563 !important;">
                <h6 class="text-muted text-uppercase small font-weight-bold">Sécurité de l'application</h6>
                <h3 class="text-dark font-weight-bold mt-2">Active</h3>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 p-4 bg-white">
        <h4 class="mb-3" style="color: #1e3a8a;"> Actions d'administration</h4>
        <div class="d-flex gap-2 flex-wrap">
            <a href="/users" class="btn btn-danger px-4 py-2 fw-bold" style="border-radius: 10px;">
                 Créer / Gérer les Utilisateurs EMS
            </a>
        </div>
    </div>
</div>
@endsection

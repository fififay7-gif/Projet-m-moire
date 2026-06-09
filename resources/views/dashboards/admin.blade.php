@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="color: #1e3a8a; font-weight: 800;">
            Administration Système
        </h1>

        
    </div>

    <!-- CARDS INFO -->
    <div class="row g-3 mb-4">

        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-3"
                 style="border-left: 6px solid #1e3a8a; border-radius: 14px;">
                <h6 style="color:#6b7280; text-transform: uppercase; font-size: 12px;">
                    Gestion des Comptes
                </h6>
                <h3 style="color:#0f2a6b; font-weight:700; margin-top:8px;">
                    Configuration Globale
                </h3>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-3"
                 style="border-left: 6px solid #f97316; border-radius: 14px;">
                <h6 style="color:#6b7280; text-transform: uppercase; font-size: 12px;">
                    Sécurité de l'application
                </h6>
                <h3 style="color:#1e3a8a; font-weight:700; margin-top:8px;">
                    Active
                </h3>
            </div>
        </div>

    </div>

    <!-- ACTIONS -->
    <div class="card shadow-sm border-0 p-4"
         style="border-radius: 16px; background: #ffffff;">

        <h4 class="mb-3" style="color: #1e3a8a; font-weight: 700;">
            Actions d'administration
        </h4>

        <a href="/users"
           class="btn px-4 py-2 fw-bold"
           style="background: linear-gradient(135deg, #1e3a8a, #2563eb);
                  color: white;
                  border-radius: 12px;
                  transition: 0.3s;">
             Créer / Gérer les Utilisateurs EMS
        </a>

    </div>

</div>
@endsection

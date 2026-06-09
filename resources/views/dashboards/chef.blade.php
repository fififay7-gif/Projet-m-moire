@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="color: #1e3a8a; font-weight: 800;">
             Tableau de Bord - Chef d'Agence
        </h1>

        <span class="badge px-3 py-2 fs-6"
              style="background: #f97316; color: white; border-radius: 12px;">
            EMS Voyage : Supervision
        </span>
    </div>

    <!-- STATS CARDS -->
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-3"
                 style="border-left: 6px solid #2563eb; border-radius: 14px;">
                <h6 style="color:#6b7280; text-transform: uppercase; font-size: 12px;">
                    Chiffre d'Affaires Mensuel
                </h6>
                <h3 style="color:#0f2a6b; font-weight:800; margin-top:8px;">
                    -- FCFA
                </h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-3"
                 style="border-left: 6px solid #10b981; border-radius: 14px;">
                <h6 style="color:#6b7280; text-transform: uppercase; font-size: 12px;">
                    Billets Vendus
                </h6>
                <h3 style="color:#111827; font-weight:800; margin-top:8px;">
                    0
                </h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-3"
                 style="border-left: 6px solid #f97316; border-radius: 14px;">
                <h6 style="color:#6b7280; text-transform: uppercase; font-size: 12px;">
                    Total Employés
                </h6>
                <h3 style="color:#1e3a8a; font-weight:800; margin-top:8px;">
                    Gestion Équipe
                </h3>
            </div>
        </div>

    </div>

    <!-- ACTIONS -->
    <div class="card shadow-sm border-0 p-4"
         style="border-radius: 16px; background: #ffffff;">

        <h4 class="mb-3" style="color: #1e3a8a; font-weight: 700;">
            Actions de Supervision
        </h4>

        <div class="d-flex gap-2 flex-wrap">

            <a href="/users"
               class="btn px-4 py-2 fw-bold"
               style="background: linear-gradient(135deg, #1e3a8a, #2563eb);
                      color: white;
                      border-radius: 12px;">
                 Gérer le personnel
            </a>

            <button class="btn px-4 py-2 fw-bold"
                    style="border: 2px solid #f97316;
                           color: #f97316;
                           border-radius: 12px;
                           background: white;">
                 Rappels & Statistiques IA
            </button>

        </div>

    </div>

</div>
@endsection

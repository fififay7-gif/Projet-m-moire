@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="color: #1e3a8a; font-weight: 800;">
             Guichet & Billetterie
        </h1>

        <span class="badge px-3 py-2 fs-6"
              style="background: #f97316; color: white; border-radius: 12px;">
            EMS Voyage : Opérations
        </span>
    </div>

    <!-- STATS -->
    <div class="row g-3 mb-4">

        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-3"
                 style="border-left: 6px solid #f97316; border-radius: 14px;">
                <h6 style="color:#6b7280; text-transform: uppercase; font-size: 12px;">
                    Mes ventes du jour
                </h6>
                <h3 style="color:#111827; font-weight:800; margin-top:8px;">
                    0 Billet
                </h3>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-3"
                 style="border-left: 6px solid #6366f1; border-radius: 14px;">
                <h6 style="color:#6b7280; text-transform: uppercase; font-size: 12px;">
                    Dernière transaction
                </h6>
                <h3 style="color:#6b7280; font-weight:700; font-size: 16px; margin-top:8px;">
                    Aucune opération effectuée
                </h3>
            </div>
        </div>

    </div>

    <!-- ACTIONS -->
    <div class="card shadow-sm border-0 p-4"
         style="border-radius: 16px; background: #ffffff;">

        <h4 class="mb-3" style="color: #1e3a8a; font-weight: 700;">
             Opérations de Vente
        </h4>

        <div class="d-flex gap-2 flex-wrap">

            <button class="btn px-4 py-2 fw-bold"
                    style="background: linear-gradient(135deg, #f97316, #fb923c);
                           color: white;
                           border-radius: 12px;">
                 Nouvelle Vente / Réservation
            </button>

            <button class="btn px-4 py-2 fw-bold"
                    style="border: 2px solid #6366f1;
                           color: #6366f1;
                           background: white;
                           border-radius: 12px;">
                 Rechercher un voyageur
            </button>

        </div>

    </div>

</div>
@endsection

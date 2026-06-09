@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h2 style="color:#0f2a6b;font-weight:bold;">
             Dashboard Comptable EMS
        </h2>
        <p class="text-muted">
            Suivi des factures, paiements et encaissements
        </p>
    </div>

    <div class="row g-4">

        <!-- TOTAL FACTURES -->
        <div class="col-md-3">
            <div class="card border-0 shadow h-100">

                <div class="card-body text-center">

                    <div style="font-size:40px;"></div>

                    <h6 class="text-muted mt-2">
                        Total Factures
                    </h6>

                    <h2 style="color:#2563eb;font-weight:bold;">
                        {{ $totalFactures }}
                    </h2>

                </div>

            </div>
        </div>

        <!-- TOTAL ENCAISSE -->
        <div class="col-md-3">
            <div class="card border-0 shadow h-100">

                <div class="card-body text-center">

                    <div style="font-size:40px;"></div>

                    <h6 class="text-muted mt-2">
                        Total Encaissé
                    </h6>

                    <h4 style="color:#16a34a;font-weight:bold;">
                        {{ number_format($totalEncaisse,0,',',' ') }}
                        FCFA
                    </h4>

                </div>

            </div>
        </div>

        <!-- RESTE A PAYER -->
        <div class="col-md-3">
            <div class="card border-0 shadow h-100">

                <div class="card-body text-center">

                    <div style="font-size:40px;"></div>

                    <h6 class="text-muted mt-2">
                        Reste à Payer
                    </h6>

                    <h4 style="color:#f97316;font-weight:bold;">
                        {{ number_format($resteAPayer,0,',',' ') }}
                        FCFA
                    </h4>

                </div>

            </div>
        </div>

        <!-- FACTURES IMPAYEES -->
        <div class="col-md-3">
            <div class="card border-0 shadow h-100">

                <div class="card-body text-center">

                    <div style="font-size:40px;"></div>

                    <h6 class="text-muted mt-2">
                        Factures Impayées
                    </h6>

                    <h2 style="color:#dc2626;font-weight:bold;">
                        {{ $facturesImpayees }}
                    </h2>

                </div>

            </div>
        </div>

    </div>

    <!-- DEUXIEME LIGNE -->

    <div class="row mt-4">

        <div class="col-md-6">

            <div class="card border-0 shadow">

                <div class="card-header text-white"
                     style="background:linear-gradient(135deg,#0f2a6b,#2563eb);">

                    <h5 class="mb-0">
                        Factures Partiellement Payées
                    </h5>

                </div>

                <div class="card-body text-center">

                    <h1 style="color:#f97316;font-weight:bold;">
                        {{ $facturesPartielles }}
                    </h1>

                    <p class="text-muted">
                        Factures ayant reçu un paiement partiel
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

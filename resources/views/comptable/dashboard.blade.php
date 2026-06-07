@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">📊 Dashboard Comptable EMS</h2>

    <div class="row">

        <div class="col-md-3">
            <div class="card p-3 bg-primary text-white">
                <h5>Total Factures</h5>
                <h3>{{ $totalFactures }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 bg-success text-white">
                <h5>Total Encaissé</h5>
                <h3>{{ number_format($totalEncaisse, 0, ',', ' ') }} FCFA</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 bg-warning text-dark">
                <h5>Reste à Payer</h5>
                <h3>{{ number_format($resteAPayer, 0, ',', ' ') }} FCFA</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 bg-danger text-white">
                <h5>Impayées</h5>
                <h3>{{ $facturesImpayees }}</h3>
            </div>
        </div>

    </div>

    <div class="row mt-4">

        <div class="col-md-6">
            <div class="card p-3">
                <h5>Factures partiellement payées</h5>
                <h2>{{ $facturesPartielles }}</h2>
            </div>
        </div>

    </div>

</div>

@endsection

@extends('layouts.app')

@section('content')
<div class="row g-4">
    {{-- Carte Réservations --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0 p-4">
            <div class="d-flex align-items-center">
                <div class="p-3 rounded-circle bg-primary-subtle text-primary me-3">
                    <i class="ti ti-calendar-event fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-0">Total Réservations</h6>
                    <h3 class="fw-bold mb-0">{{ $totalReservations }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Carte Versements Mensuels --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0 p-4">
            <div class="d-flex align-items-center">
                <div class="p-3 rounded-circle bg-success-subtle text-success me-3">
                    <i class="ti ti-wallet fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-0">Versements (Ce mois)</h6>
                    <h3 class="fw-bold mb-0">{{ $versementsMensuels }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Carte Paiements --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0 p-4">
            <div class="d-flex align-items-center">
                <div class="p-3 rounded-circle bg-warning-subtle text-warning me-3">
                    <i class="ti ti-credit-card fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-0">Total Paiements</h6>
                    <h3 class="fw-bold mb-0">{{ $totalPaiements }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

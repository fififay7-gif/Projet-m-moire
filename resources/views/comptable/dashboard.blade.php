@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Tableau de bord Comptable</h3>
        <span class="text-muted small">Mise à jour : {{ date('d/m/Y H:i') }}</span>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h6 class="text-secondary fw-semibold text-uppercase small">Total Réservations</h6>
                    <h2 class="display-6 fw-bold mt-2 text-primary">{{ $totalReservations ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h6 class="text-secondary fw-semibold text-uppercase small">Versements (Juin)</h6>
                    <h2 class="display-6 fw-bold mt-2 text-success">{{ $versementsMensuels ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h6 class="text-secondary fw-semibold text-uppercase small">Total Paiements</h6>
                    <h2 class="display-6 fw-bold mt-2 text-dark">{{ $totalPaiements ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <div class="card shadow-sm border-0 p-4">
                <h5 class="text-secondary mb-4">Évolution des activités</h5>
                <canvas id="myChart" height="80"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    window.onload = function() {
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Réservations', 'Versements', 'Paiements'],
                datasets: [{
                    label: 'Nombre d\'opérations',
                    data: [{{ $totalReservations ?? 0 }}, {{ $versementsMensuels ?? 0 }}, {{ $totalPaiements ?? 0 }}],
                    borderColor: '#0d6efd',
                    tension: 0.4,
                    fill: true,
                    backgroundColor: 'rgba(13, 110, 253, 0.1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true
            }
        });
    };
</script>
@endsection

@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- En-tête --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold" style="color: #1e3a8a;">Tableau de Bord</h2>
        <span class="text-muted">Espace Direction - {{ date('Y') }}</span>
    </div>

    {{-- 1. Cartes de Statistiques --}}
    <div class="row g-4 mb-4">
        @foreach([
            ['label' => 'Clients', 'val' => $totalClients, 'icon' => 'ti-users', 'color' => '#f97316'],
            ['label' => 'Réservations', 'val' => $totalReservations, 'icon' => 'ti-ticket', 'color' => '#6366f1'],
            ['label' => 'Paiements', 'val' => $totalPaiements, 'icon' => 'ti-wallet', 'color' => '#10b981'],
            ['label' => 'CA Annuel', 'val' => number_format($caAnnuel, 0, ',', ' ') . ' FCFA', 'icon' => 'ti-bar-chart', 'color' => '#1e3a8a']
        ] as $stat)
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 p-3" style="border-radius: 12px;">
                <div class="d-flex align-items-center">
                    <div class="p-3 rounded-circle" style="background: {{ $stat['color'] }}20; color: {{ $stat['color'] }};">
                        <i class="ti {{ $stat['icon'] }} fs-4"></i>
                    </div>
                    <div class="ms-3">
                        <p class="text-muted mb-0" style="font-size: 11px; text-transform: uppercase;">{{ $stat['label'] }}</p>
                        <h5 class="fw-bold mb-0">{{ $stat['val'] }}</h5>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- 2. Graphiques --}}
    <div class="row g-4">
        <div class="col-12 col-xl-6">
            <div class="card shadow-sm border-0 p-4" style="border-radius: 12px; height: 350px;">
                <h6 class="fw-bold mb-3" style="color: #1e3a8a;">Évolution CA Mensuel</h6>
                <canvas id="chartMensuel"></canvas>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <div class="card shadow-sm border-0 p-4" style="border-radius: 12px; height: 350px;">
                <h6 class="fw-bold mb-3" style="color: #1e3a8a;">Bilan Annuel</h6>
                <canvas id="chartAnnuel"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Configuration commune des graphiques
    const options = { responsive: true, maintainAspectRatio: false };

    // Graphique Mensuel
    new Chart(document.getElementById('chartMensuel'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
            datasets: [{
                label: 'CA Mensuel',
                data: Object.values(@json($statsMensuelles ?? [])),
                borderColor: '#1e3a8a',
                backgroundColor: 'rgba(30, 58, 138, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: options
    });

    // Graphique Annuel
    new Chart(document.getElementById('chartAnnuel'), {
        type: 'bar',
        data: {
            labels: Object.keys(@json($statsAnnuelles ?? [])),
            datasets: [{
                label: 'CA Annuel',
                data: Object.values(@json($statsAnnuelles ?? [])),
                backgroundColor: '#f97316'
            }]
        },
        options: options
    });
});
</script>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 style="color: #1e3a8a; font-weight: 800; margin-bottom: 0;">Tableau de bord</h1>
            <p class="text-muted" style="font-size: 14px;">Espace Agent de Comptoir - EMS Voyage</p>
        </div>
        {{-- Vous pouvez ajouter un bouton d'action ici si besoin --}}
    </div>

    <div class="row g-4 mb-4">
        {{-- Graphique Clients --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-4" style="border-radius: 16px;">
                <h6 style="color:#6b7280; text-transform: uppercase; font-size: 12px; font-weight:700;">Progression Clients</h6>
                <h2 style="color:#111827; font-weight:800; margin-top: 5px;">{{ $nombreClients }}</h2>
                <canvas id="clientChart" height="100"></canvas>
            </div>
        </div>

        {{-- Graphique Réservations --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-4" style="border-radius: 16px;">
                <h6 style="color:#6b7280; text-transform: uppercase; font-size: 12px; font-weight:700;">Progression Réservations</h6>
                <h2 style="color:#111827; font-weight:800; margin-top: 5px;">{{ $nombreReservations }}</h2>
                <canvas id="resChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    // Configuration Graphique Clients (Orange EMS)
    new Chart(document.getElementById('clientChart'), {
        type: 'line',
        data: {
            labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
            datasets: [{
                data: [0, 1, 2, 2, 3, 4, {{ $nombreClients }}],
                borderColor: '#f97316',
                backgroundColor: 'rgba(249, 115, 22, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: { plugins: { legend: { display: false } }, responsive: true }
    });

    // Configuration Graphique Réservations (Bleu EMS)
    new Chart(document.getElementById('resChart'), {
        type: 'line',
        data: {
            labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
            datasets: [{
                data: [0, 1, 1, 3, 2, 4, {{ $nombreReservations }}],
                borderColor: '#1e3a8a',
                backgroundColor: 'rgba(30, 58, 138, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: { plugins: { legend: { display: false } }, responsive: true }
    });
</script>
@endsection

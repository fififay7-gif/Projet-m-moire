@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="color: #1e3a8a; font-weight: 800;">
            Administration Système
        </h1>
    </div>

    <div class="row g-3 mb-4">

        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-3"
                 style="border-left: 6px solid #1e3a8a; border-radius: 14px;">
                <h6 style="color:#6b7280; text-transform: uppercase; font-size: 12px; margin: 0;">
                    Nombre d'utulisateurs
                </h6>
                <h3 style="color:#0f2a6b; font-weight:700; margin-top:8px; margin-bottom: 0;">
                    {{ $totalUsers }} {{ $totalUsers > 1 ? 'Utilisateurs' : 'Utilisateur' }}
                </h3>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-3"
                 style="border-left: 6px solid #137333; border-radius: 14px;"> <h6 style="color:#6b7280; text-transform: uppercase; font-size: 12px; margin: 0;">
                    Nombre d'actifs
                </h6>
                <h3 style="color:#137333; font-weight:700; margin-top:8px; margin-bottom: 0;">
                    {{ $activeUsers }} Actif{{ $activeUsers > 1 ? 's' : '' }}
                </h3>
            </div>
        </div>

    </div>

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
                  transition: 0.3s;
                  display: inline-block;
                  text-decoration: none;">
             Créer / Gérer les Utilisateurs EMS
        </a>
        <div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm border-0 p-4" style="border-radius: 16px; background: #ffffff;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 style="color: #1e3a8a; font-weight: 700; margin: 0;">
                    Évolution des Inscriptions
                </h5>
                
            </div>

            <div style="position: relative; height:280px; width:100%">
                <canvas id="userEvolutionChart"></canvas>
            </div>
        </div>
    </div>
</div>

    </div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Suppression de l'erreur "Class 'Chart' is not imported" en passant par l'objet global window
    const ctx = document.getElementById('userEvolutionChart').getContext('2d');

    // Les données PHP cachées dans des chaînes de caractères pour éliminer l'erreur "Decorators are not valid here"
    const chartLabels = JSON.parse('{!! json_encode($months) !!}');
    const totalUsersData = JSON.parse('{!! json_encode($totalData) !!}');
    const activeUsersData = JSON.parse('{!! json_encode($activeData) !!}');

    new window.Chart(ctx, {
        data: {
            labels: chartLabels,
            datasets: [
                {
                    type: 'line',
                    label: 'Utilisateurs Actifs',
                    data: activeUsersData,
                    borderColor: '#137333',
                    borderWidth: 3,
                    pointBackgroundColor: '#137333',
                    pointBorderColor: '#ffffff',
                    pointRadius: 4,
                    tension: 0.3,
                    order: 1
                },
                {
                    type: 'bar',
                    label: 'Total Utilisateurs',
                    data: totalUsersData,
                    backgroundColor: 'rgba(37, 99, 235, 0.2)',
                    borderColor: '#2563eb',
                    borderWidth: 1,
                    borderRadius: 6,
                    barThickness: 25,
                    order: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 12,
                        font: { size: 12, weight: 'bold' },
                        color: '#64748b'
                    }
                },
                tooltip: {
                    backgroundColor: '#1e3a8a',
                    padding: 10,
                    cornerRadius: 8
                }
            },
            scales: {
                y: {
                    grid: { color: '#f1f5f9' },
                    ticks: {
                        color: '#64748b',
                        stepSize: 1
                    },
                    border: { display: false }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#64748b' },
                    border: { display: false }
                }
            }
        }
    });
});
</script>
@endsection

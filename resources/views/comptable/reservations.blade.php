@extends('layouts.app')

@section('content')

<style>
    :root{
        --ems-blue:#1e3a8a;
        --ems-orange:#ff7a00;
        --ems-light:#f8f9fa;
    }

    .card-ems{
        border:none;
        border-radius:15px;
        overflow:hidden;
    }

    .header-ems{
        background:linear-gradient(135deg,var(--ems-blue),#2749a8);
        color:white;
    }

    .table thead th{
        background-color:var(--ems-blue) !important;
        color:white !important;
        border:none;
        font-size:12px;
        text-transform:uppercase;
        letter-spacing:0.5px;
    }

    .table tbody tr:hover{
        background:#f5f8ff;
    }

    .badge-paiement{
        background:#eef4ff;
        color:var(--ems-blue);
        border:1px solid #d6e4ff;
        padding:6px 10px;
        border-radius:8px;
        font-size:12px;
    }

    .montant-ems{
        color:var(--ems-orange);
        font-weight:700;
    }

    .title-ems{
        color:var(--ems-blue);
        font-weight:800;
    }

    .card-header-ems{
        background:var(--ems-blue);
        color:white;
    }

    .table td{
        vertical-align:middle;
    }

    .code-reservation{
        color:var(--ems-blue);
        font-weight:700;
    }

    .empty-state{
        padding:50px;
        color:#6c757d;
    }
</style>

<div class="container-fluid px-4 py-4" style="background-color:#f8f9fa; min-height:100vh;">

    {{-- En-tête --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <h4 class="title-ems mb-0">
            <i class="ti ti-report-money me-2"></i>
            Espace Comptabilité : Registre Global
        </h4>
    </div>

    <div class="card card-ems shadow-sm">

        <div class="card-header card-header-ems py-3">
            <h6 class="mb-0 fw-bold">
                <i class="ti ti-list-details me-2"></i>
                Liste détaillée des réservations
            </h6>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th class="ps-4">Code</th>
                            <th>Client</th>
                            <th>Destination</th>
                            <th>Montant</th>
                            <th>Règlement</th>
                            <th>Date</th>
                            <th>Statut</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($reservations as $reservation)

                        <tr>

                            {{-- CODE --}}
                            <td class="ps-4 code-reservation">
                                {{ $reservation->code ?? 'RES-'.$reservation->id }}
                            </td>

                            {{-- CLIENT --}}
                            <td>
                                {{ $reservation->client->prenom ?? '' }}
                                {{ $reservation->client->nom ?? '' }}
                            </td>

                            {{-- DESTINATION --}}
                            <td class="fw-semibold">
                                {{ $reservation->destination ?? '---' }}
                            </td>

                            {{-- MONTANT --}}
                            <td class="montant-ems">
                                {{ $reservation->montant > 0
                                    ? number_format($reservation->montant,0,',',' ') . ' FCFA'
                                    : '---'
                                }}
                            </td>

                            {{-- MODE DE PAIEMENT --}}
                            <td>
                                @if($reservation->mode_paiement)
                                    <span class="badge-paiement">
                                        {{ $reservation->mode_paiement }}
                                    </span>
                                @else
                                    <span class="text-muted">---</span>
                                @endif
                            </td>

                            {{-- DATE --}}
                            <td class="text-muted">
                                {{ $reservation->created_at
                                    ? $reservation->created_at->format('d/m/Y')
                                    : '---'
                                }}
                            </td>

                            {{-- STATUT --}}
                            <td>

                                @php
                                    $st = strtolower($reservation->statut ?? '');
                                @endphp

                                @if(in_array($st,['valide','validee']))
                                    <span class="badge bg-success">
                                        Validée
                                    </span>

                                @elseif(in_array($st,['rejete','rejetee']))
                                    <span class="badge bg-danger">
                                        Rejetée
                                    </span>

                                @else
                                    <span class="badge bg-warning text-dark">
                                        En attente
                                    </span>
                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="7" class="text-center empty-state">
                                <i class="ti ti-folder-off fs-1 d-block mb-2"></i>
                                Aucune réservation trouvée.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection

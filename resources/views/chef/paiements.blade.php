@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4" style="background-color: #f8f9fa; min-height: 100vh;">

    {{-- En-tête de la page épuré (Pas de bouton + Nouveau Paiement pour le Chef) --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2" style="border-bottom: 2px solid #e9ecef;">
        <h4 class="fw-bold mb-0" style="color: #1e3a8a;">
            <i class="ti ti-report-money me-2" style="color: #ff6600;"></i>Liste des Paiements
        </h4>
        <span class="badge px-3 py-2 text-white" style="background-color: #ff6600; font-size: 13px; border-radius: 20px;">
            Espace Consultation (Lecture Seule)
        </span>
    </div>

    {{-- Tableau des Paiements --}}
    <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 14px;">
                    <thead class="table-light text-dark fw-bold">
                        <tr>
                            <th class="ps-4 py-3" style="width: 12%;">Réf</th>
                            <th style="width: 15%;">Date</th>
                            <th style="width: 25%;">Client</th>
                            <th style="width: 15%;">Mode</th>
                            <th style="width: 18%;">Montant</th>
                            <th class="text-center" style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($paiements as $paiement)
                        <tr style="transition: all 0.2s ease;">
                            {{-- Référence --}}
                            <td class="ps-4 fw-bold text-primary">
                                #{{ $paiement->reference ?? 'PAY-' . $paiement->id }}
                            </td>

                            {{-- Date --}}
                            <td class="text-secondary">
                                {{ $paiement->created_at ? $paiement->created_at->format('d/m/Y') : ($paiement->date ?? '---') }}
                            </td>

                            {{-- Nom du Client --}}
                            <td class="fw-semibold text-dark">
                                {{ $paiement->client->prenom ?? '' }} {{ $paiement->client->nom ?? $paiement->nom_client ?? '---' }}
                            </td>

                            {{-- Mode de paiement --}}
                            <td>
                                @if(strtolower($paiement->mode) === 'espèces' || strtolower($paiement->mode) === 'especes')
                                    <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 12px;">Espèces</span>
                                @elseif(strtolower($paiement->mode) === 'carte bancaire' || strtolower($paiement->mode) === 'carte')
                                    <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 12px;">Carte Bancaire</span>
                                @else
                                    <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 12px;">{{ $paiement->mode ?? '---' }}</span>
                                @endif
                            </td>

                            {{-- Montant --}}
                            <td class="fw-bold text-dark">
                                {{ number_format($paiement->montant, 0, ',', ' ') }} FCFA
                            </td>

                            {{-- Action : Voir le Bordereau --}}
                            <td class="text-center">
                                <a href="{{ route('comptable.paiements.bordereau', $paiement->id) }}" class="btn btn-sm btn-outline-info text-nowrap" style="border-color: #0dcaf0; border-radius: 6px; font-size: 13px;">
                                    <i class="ti ti-printer me-1"></i> Voir Bordereau
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="ti ti-wallet-off d-block fs-2 mb-2 text-secondary"></i>
                                Aucun paiement enregistré dans le système.
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

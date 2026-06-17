@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4" style="background-color: #f8f9fa; min-height: 100vh;">

    {{-- En-tête de la page --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2" style="border-bottom: 2px solid #e9ecef;">
        <h4 class="fw-bold mb-0" style="color: #1e3a8a;">
            <i class="ti ti-calendar-check me-2"></i>Validation des Réservations & Versements
        </h4>
        <span class="badge px-3 py-2 text-white" style="background-color: #1a365d; font-size: 13px; border-radius: 20px;">
            Espace Décisions
        </span>
    </div>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-left: 4px solid #198754 !important;">
            <i class="ti ti-circle-check-filled me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tableau des demandes --}}
    <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
        <div class="card-header py-3 text-white d-flex justify-content-between align-items-center" style="background-color: #1a365d;">
            <h6 class="mb-0 fw-semibold text-white">
                <i class="ti ti-list-details me-2"></i>Demandes de réservations en attente de traitement
            </h6>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 14px; table-layout: fixed; width: 100%;">
                    <thead class="table-light text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="ps-4 py-3 text-secondary" style="width: 11%;">Code</th>
                            <th class="text-secondary" style="width: 14%;">Client</th>
                            <th class="text-secondary" style="width: 11%;">Destination</th>
                            <th class="text-secondary" style="width: 16%;">Montant Versé</th>
                            <th class="text-secondary" style="width: 13%;">Règlement</th>
                            <th class="text-secondary" style="width: 10%;">Statut</th>
                            <th class="text-secondary" style="width: 11%;">Motif Rejet</th>
                            <th class="text-center text-secondary pe-4" style="width: 14%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservations as $reservation)
                        <tr style="transition: all 0.2s ease;">

                            {{-- 1. CODE --}}
                            <td class="ps-4 fw-bold text-dark">
                                {{ $reservation->code ?? '#' . $reservation->id }}
                            </td>

                            {{-- 2. CLIENT --}}
                            <td>
                                <div class="fw-semibold text-secondary text-truncate">
                                    @if($reservation->client)
                                        {{ $reservation->client->prenom ?? '' }} {{ $reservation->client->nom ?? '' }}
                                    @else
                                        <span class="text-muted fw-normal">---</span>
                                    @endif
                                </div>
                            </td>

                            {{-- 3. DESTINATION --}}
                            <td class="fw-semibold text-dark">
                                {{ $reservation->destination ?? '---' }}
                            </td>

   {{-- 4. MONTANT VERSÉ --}}
<td>
    @php
        // On récupère la valeur brute pour être sûr
        $montant = (float) $reservation->montant;
    @endphp

    @if($montant > 0)
        <span class="fw-bold text-success">
            {{ number_format($montant, 0, ',', ' ') }} FCFA
        </span>
    @else
        <span class="text-muted small">Non défini</span>
    @endif
</td>

{{-- 5. RÈGLEMENT --}}
<td>
    @if(!empty($reservation->mode_paiement) && $reservation->mode_paiement !== 'N/A')
        <span class="badge bg-light text-dark border">{{ $reservation->mode_paiement }}</span>
    @else
        <span class="text-muted small">---</span>
    @endif
</td>                         {{-- 6. STATUT --}}
                            <td>
                                @php $st = strtolower($reservation->statut); @endphp
                                @if(in_array($st, ['validee', 'validated', 'valide']))
                                    <span class="badge bg-success text-white px-2 py-1 fw-semibold" style="font-size: 11px; border-radius: 6px;">Validée</span>
                                @elseif(in_array($st, ['rejetee', 'rejected', 'rejete']))
                                    <span class="badge bg-danger text-white px-2 py-1 fw-semibold" style="font-size: 11px; border-radius: 6px;">Rejetée</span>
                                @else
                                    <span class="badge px-2 py-1 fw-semibold" style="font-size: 11px; border-radius: 6px; color: #b45309 !important; background-color: #fef3c7 !important;">En attente</span>
                                @endif
                            </td>

                            {{-- 7. MOTIF DE REJET --}}
                            <td class="text-danger text-truncate" title="{{ $reservation->motif_rejet }}">
                                {{ $reservation->motif_rejet ?? '---' }}
                            </td>

                           {{-- 8. ACTIONS --}}
<td class="pe-4 text-center">
    <div class="d-flex justify-content-center align-items-center gap-1">

        {{-- Toujours afficher le bouton Modifier --}}
        <button type="button" class="btn btn-sm text-white px-2" data-bs-toggle="modal" data-bs-target="#editModalForm{{ $reservation->id }}" style="background-color: #ff6b00; border-radius: 6px; height: 30px; width: 30px;" title="Modifier">
            <i class="ti ti-edit"></i>
        </button>

        {{-- Afficher le bouton VALIDER seulement si elle n'est PAS déjà validée --}}
        @if(!in_array($st, ['validee', 'validated', 'valide']))
            <form action="{{ route('reservations.valider', $reservation->id) }}" method="POST" class="m-0">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-success btn-sm" style="height: 30px;" title="Valider">
                    <i class="ti ti-check"></i>
                </button>
            </form>
        @endif

        {{-- Afficher le bouton REJETER seulement si elle n'est PAS déjà rejetée --}}
        @if(!in_array($st, ['rejetee', 'rejected', 'rejete']))
            <button type="button" class="btn btn-danger btn-sm px-2" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $reservation->id }}" style="height: 30px;" title="Rejeter">
                <i class="ti ti-x"></i>
            </button>
        @endif

        {{-- Bouton Supprimer --}}
        <button type="button" class="btn btn-sm btn-outline-danger px-2" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $reservation->id }}" style="border-radius: 6px; height: 30px; width: 30px;" title="Supprimer">
            <i class="ti ti-trash"></i>
        </button>
    </div>
</td>
                        </tr>

                        {{-- ================= MODAL : MODIFICATION COMPLÈTE ================= --}}
                        <div class="modal fade" id="editModalForm{{ $reservation->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden;">
                                    <div class="modal-header text-white py-3" style="background-color: #1a365d;">
                                        <h5 class="modal-title fw-bold mb-0">
                                            <i class="ti ti-edit me-2" style="color: #ff6b00;"></i>Modifier la réservation & versement : {{ $reservation->code ?? '#' . $reservation->id }}
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form method="POST" action="{{ url('/reservations/' . $reservation->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-body text-start p-4">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold" style="color: #1e3a8a;">Client <span class="text-danger">*</span></label>
                                                    <select name="client_id" class="form-select" style="border-radius: 10px;" required>
                                                        @foreach($clients as $client)
                                                            <option value="{{ $client->id }}" {{ $reservation->client_id == $client->id ? 'selected' : '' }}>
                                                                {{ $client->prenom }} {{ $client->nom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold" style="color: #1e3a8a;">Type de voyage <span class="text-danger">*</span></label>
                                                    <select name="type_service" class="form-select" style="border-radius: 10px;" required>
                                                        <option value="Aller simple" {{ $reservation->type_service == 'Aller simple' ? 'selected' : '' }}>Aller simple</option>
                                                        <option value="Aller-Retour" {{ $reservation->type_service == 'Aller-Retour' ? 'selected' : '' }}>Aller-Retour</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold" style="color: #1e3a8a;">Destination <span class="text-danger">*</span></label>
                                                    <select name="destination" class="form-select" style="border-radius: 10px;" required>
                                                        <option value="Dakar" {{ $reservation->destination == 'Dakar' ? 'selected' : '' }}>Dakar</option>
                                                        <option value="Paris" {{ $reservation->destination == 'Paris' ? 'selected' : '' }}>Paris</option>
                                                        <option value="Ziguinchor" {{ $reservation->destination == 'Ziguinchor' ? 'selected' : '' }}>Ziguinchor</option>
                                                        <option value="Bamako" {{ $reservation->destination == 'Bamako' ? 'selected' : '' }}>Bamako</option>
                                                        <option value="Casablanca" {{ $reservation->destination == 'Casablanca' ? 'selected' : '' }}>Casablanca</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold" style="color: #1e3a8a;">Classe <span class="text-danger">*</span></label>
                                                    <select name="classe" class="form-select" style="border-radius: 10px;" required>
                                                        <option value="Économique" {{ $reservation->classe == 'Économique' ? 'selected' : '' }}>Économique</option>
                                                        <option value="Business" {{ $reservation->classe == 'Business' ? 'selected' : '' }}>Business</option>
                                                        <option value="Première" {{ $reservation->classe == 'Première' ? 'selected' : '' }}>Première Class</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold" style="color: #1e3a8a;">Montant versé (FCFA) <span class="text-danger">*</span></label>
                                                    <input type="number" step="0.01" name="montant" value="{{ $reservation->montant ?? 0 }}" class="form-control" style="border-radius: 10px;" required>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold" style="color: #1e3a8a;">Mode de Règlement <span class="text-danger">*</span></label>
                                                    <select name="mode_paiement" class="form-select" style="border-radius: 10px;" required>
                                                        <option value="Espèces" {{ $reservation->mode_paiement == 'Espèces' ? 'selected' : '' }}>Espèces</option>
                                                        <option value="Carte" {{ $reservation->mode_paiement == 'Carte' ? 'selected' : '' }}>Carte</option>
                                                        <option value="Wave" {{ $reservation->mode_paiement == 'Wave' ? 'selected' : '' }}>Wave</option>
                                                        <option value="Orange Money" {{ $reservation->mode_paiement == 'Orange Money' ? 'selected' : '' }}>Orange Money</option>
                                                        <option value="Chèque" {{ $reservation->mode_paiement == 'Chèque' ? 'selected' : '' }}>Chèque</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light border-0 py-2">
                                            <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn text-white px-4" style="background-color: #ff6b00; border: none; border-radius: 8px;">Enregistrer les changements</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- ================= MODAL : SPÉCIFIER LE REJET ================= --}}
                        <div class="modal fade" id="rejectModal{{ $reservation->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title fs-6 text-white">Spécifier le motif du rejet</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ url('/reservations/' . $reservation->id . '/reject') }}">
                                        @csrf
                                        <div class="modal-body py-3">
                                            <input type="text" name="motif_rejet" placeholder="Écrivez le motif ici..." required class="form-control" style="border-radius: 6px;">
                                        </div>
                                        <div class="modal-footer bg-light border-0">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-sm btn-danger">Confirmer le Rejet</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- ================= MODAL : SUPPRESSION DÉFINITIVE ================= --}}
                        <div class="modal fade" id="deleteModal{{ $reservation->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-danger text-white py-2">
                                        <h5 class="modal-title fs-6 text-white"><i class="ti ti-alert-triangle me-2"></i>Confirmation</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center py-3">
                                        <p class="mb-1 text-secondary fs-7">Êtes-vous sûr de vouloir définitivement supprimer cette réservation ?</p>
                                        <span class="badge bg-light text-danger fw-bold border border-danger-subtle">{{ $reservation->code ?? '#' . $reservation->id }}</span>
                                    </div>
                                    <div class="modal-footer bg-light border-0 py-2 d-flex justify-content-center gap-2">
                                        <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Annuler</button>
                                        <form method="POST" action="{{ url('/reservations/' . $reservation->id) }}" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger px-3">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="ti ti-calendar-x d-block fs-2 mb-2 text-secondary"></i>
                                Aucune réservation en attente de validation.
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

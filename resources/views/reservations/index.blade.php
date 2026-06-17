@extends('layouts.app')

@section('content')

<div class="container-fluid px-4 py-4" style="background-color: #f8f9fa; min-height: 100vh;">

    {{-- En-tête de la page --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2" style="border-bottom: 2px solid #e9ecef;">
        <h4 class="fw-bold mb-0" style="color: #1e3a8a;">
            <i class="ti ti-calendar-check me-2"></i>Gestion des Réservations
        </h4>

        {{-- Bouton pour ouvrir le modal unique --}}
        @if(auth()->user()->role !== 'chef_agence')
            <button type="button"
                    class="btn fw-bold px-4 py-2 text-white shadow-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#modalReservation"
                    style="background: linear-gradient(135deg, #1e3a8a, #2563eb); border-radius: 12px; font-size: 14px; border: none;">
                 <i class="ti ti-plus me-1"></i> Nouvelle réservation
            </button>
        @else
            <span class="badge px-3 py-2 text-white" style="background-color: #ff6600; font-size: 13px; border-radius: 20px;">
                Espace Supervision (Lecture Seule)
            </span>
        @endif
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
                <i class="ti ti-list-details me-2"></i>Liste de vos réservations enregistrées
            </h6>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 14px; table-layout: fixed; width: 100%;">
                    <thead class="table-light text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="ps-4 py-3 text-secondary" style="width: 12%;">Code</th>
                            <th class="text-secondary" style="width: 18%;">Client</th>
                            <th class="text-secondary" style="width: 15%;">Destination</th>
                            <th class="text-secondary" style="width: 12%;">Classe</th>
                            <th class="text-secondary" style="width: 12%;">Statut</th>
                            <th class="text-secondary" style="width: 16%;">Motif de Rejet</th>
                            <th class="text-secondary" style="width: 15%;">Date Réservation</th>

                            @if(auth()->user()->role !== 'chef_agence')
                                <th class="text-center text-secondary pe-4" style="width: 12%;">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservations as $reservation)
<tr style="transition: all 0.2s ease;">

    <td class="ps-4 fw-bold text-dark">
        {{ $reservation->code ?? '#' . $reservation->id }}
    </td>

    <td>
        <div class="fw-semibold text-secondary text-truncate">
            {{ $reservation->client->prenom ?? '' }} {{ $reservation->client->nom ?? '---' }}
        </div>
    </td>

    <td class="fw-semibold text-dark text-truncate">
        <i class="ti ti-plane-departure me-1 text-primary" style="font-size: 14px;"></i>
        {{ $reservation->destination ?? '---' }}
    </td>

    <td>
        @php $classe = $reservation->classe ?? ''; @endphp
        @if($classe === 'Business')
            <span class="badge bg-light-warning text-warning border border-warning px-2 py-1" style="border-radius: 6px; font-size: 11px;">Business</span>
        @elseif($classe === 'Première' || $classe === 'Première Class')
            <span class="badge bg-light-danger text-danger border border-danger px-2 py-1" style="border-radius: 6px; font-size: 11px;">Première</span>
        @else
            <span class="badge bg-light-secondary text-secondary border border-secondary px-2 py-1" style="border-radius: 6px; font-size: 11px;">Économique</span>
        @endif
    </td>

    <td>
        @php $st = strtolower($reservation->statut); @endphp
        @if(in_array($st, ['validee', 'validated', 'valide']))
            <span class="badge bg-success text-white px-2.5 py-1.5 fw-semibold" style="font-size: 11px; border-radius: 6px;">Validée</span>
        @elseif(in_array($st, ['rejetee', 'rejected', 'rejete']))
            <span class="badge bg-danger text-white px-2.5 py-1.5 fw-semibold" style="font-size: 11px; border-radius: 6px;">Rejetée</span>
        @else
            <span class="badge px-2.5 py-1.5 fw-semibold" style="font-size: 11px; border-radius: 6px; color: #b45309 !important; background-color: #fef3c7 !important;">En attente</span>
        @endif
    </td>

    <td class="text-danger fw-medium text-truncate">
        {{ $reservation->motif_rejet ?? '---' }}
    </td>

    <td class="text-muted" style="font-size: 13px;">
        <i class="ti ti-clock me-1" style="font-size: 12px;"></i>
        {{ $reservation->created_at ? $reservation->created_at->format('d/m/Y à H:i') : '---' }}
    </td>

    @if(auth()->user()->role !== 'chef_agence')
    <td class="pe-4 text-center">
        <div class="d-flex justify-content-center align-items-center gap-1">

            {{-- ICI : On utilise bien l'ID unique de la réservation --}}
            <button type="button"
                    class="btn btn-sm text-white px-2 d-inline-flex align-items-center justify-content-center"
                    data-bs-toggle="modal"
                    data-bs-target="#editModalForm{{ $reservation->id }}"
                    style="background-color: #ff6b00; border-radius: 6px; height: 32px; width: 32px; border: none;"
                    title="Modifier la réservation">
                <i class="ti ti-edit" style="font-size: 14px;"></i>
            </button>

            <button type="button"
                    class="btn btn-sm btn-outline-danger px-2 d-inline-flex align-items-center justify-content-center"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteModal{{ $reservation->id }}"
                    style="border-radius: 6px; height: 32px; width: 32px;"
                    title="Supprimer la réservation">
                <i class="ti ti-trash" style="font-size: 14px;"></i>
            </button>
        </div>
    </td>
    @endif
</tr>

{{-- ================= LE MODAL DE MODIFICATION (DOIT ÊTRE À L'INTÉRIEUR DE LA BOUCLE FORELSE) ================= --}}
@if(auth()->user()->role !== 'chef_agence')
<div class="modal fade" id="editModalForm{{ $reservation->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden;">
            <div class="modal-header text-white py-3" style="background-color: #1a365d;">
                <h5 class="modal-title fw-bold mb-0">
                    <i class="ti ti-edit me-2" style="color: #ff6b00;"></i>Modifier la réservation : {{ $reservation->code ?? '#' . $reservation->id }}
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
                            <select name="client_id" class="form-select" style="border-radius: 10px; border: 1px solid #d1d5db;" required>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ $reservation->client_id == $client->id ? 'selected' : '' }}>
                                        {{ $client->prenom ?? '' }} {{ $client->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="color: #1e3a8a;">Type de voyage <span class="text-danger">*</span></label>
                            <select name="type_service" class="form-select" style="border-radius: 10px; border: 1px solid #d1d5db;" required>
                                <option value="Aller simple" {{ $reservation->type_service == 'Aller simple' ? 'selected' : '' }}>Aller simple</option>
                                <option value="Aller-Retour" {{ $reservation->type_service == 'Aller-Retour' ? 'selected' : '' }}>Aller-Retour</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="color: #1e3a8a;">Destination <span class="text-danger">*</span></label>
                            <select name="destination" class="form-select" style="border-radius: 10px; border: 1px solid #d1d5db;" required>
                                <option value="Dakar" {{ $reservation->destination == 'Dakar' ? 'selected' : '' }}>Dakar</option>
                                <option value="Paris" {{ $reservation->destination == 'Paris' ? 'selected' : '' }}>Paris</option>
                                <option value="Ziguinchor" {{ $reservation->destination == 'Ziguinchor' ? 'selected' : '' }}>Ziguinchor</option>
                                <option value="Bamako" {{ $reservation->destination == 'Bamako' ? 'selected' : '' }}>Bamako</option>
                                <option value="Casablanca" {{ $reservation->destination == 'Casablanca' ? 'selected' : '' }}>Casablanca</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="color: #1e3a8a;">Classe de Voyage <span class="text-danger">*</span></label>
                            <select name="classe" class="form-select" style="border-radius: 10px; border: 1px solid #d1d5db;" required>
                                <option value="Économique" {{ $reservation->classe == 'Économique' ? 'selected' : '' }}>Économique</option>
                                <option value="Business" {{ $reservation->classe == 'Business' ? 'selected' : '' }}>Business</option>
                                <option value="Première" {{ $reservation->classe == 'Première' || $reservation->classe == 'Première Class' ? 'selected' : '' }}>Première Class</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="color: #1e3a8a;">Montant versé (FCFA) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="montant" value="{{ $reservation->montant }}" class="form-control" style="border-radius: 10px; border: 1px solid #d1d5db;" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="color: #1e3a8a;">Mode de Règlement <span class="text-danger">*</span></label>
                            <select name="mode_paiement" class="form-select" style="border-radius: 10px; border: 1px solid #d1d5db;" required>
                                <option value="Espèces" {{ $reservation->mode_paiement == 'Espèces' ? 'selected' : '' }}>Espèces</option>
                                <option value="Carte" {{ $reservation->mode_paiement == 'Carte' ? 'selected' : '' }}>Carte</option>
                                <option value="Wave" {{ $reservation->mode_paiement == 'Wave' ? 'selected' : '' }}>Wave</option>
                                <option value="Orange Money" {{ $reservation->mode_paiement == 'Orange Money' ? 'selected' : '' }}>Orange Money</option>
                                <option value="Chèque" {{ $reservation->mode_paiement == 'Chèque' ? 'selected' : '' }}>Chèque</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer bg-light border-0 py-3">
                    <button type="button" class="btn btn-secondary fw-semibold px-4" data-bs-dismiss="modal" style="border-radius: 10px;">Annuler</button>
                    <button type="submit" class="btn text-white fw-bold px-4" style="background-color: #ff6b00; border-radius: 10px; border: none;">
                        Mettre à jour la réservation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif


                        {{-- MODAL : SUPPRESSION SÉCURISÉE --}}
                        @if(auth()->user()->role !== 'chef_agence')
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
                                        <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal" style="border-radius: 6px; font-size: 13px;">Annuler</button>
                                        <form method="POST" action="{{ url('/reservations/' . $reservation->id) }}" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger px-3" style="border-radius: 6px; font-size: 13px;">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @empty
                        <tr>
                            <td colspan="{{ auth()->user()->role === 'chef_agence' ? '7' : '8' }}" class="text-center text-muted py-5">
                                <i class="ti ti-calendar-x d-block fs-2 mb-2 text-secondary"></i>
                                Aucune réservation enregistrée à votre niveau.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- ================= MODAL COMPLET : INTEGRATION DU FORMULAIRE DE CRÉATION ================= --}}
@if(auth()->user()->role !== 'chef_agence')
<div class="modal fade" id="modalReservation" tabindex="-1" aria-labelledby="modalReservationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden; background: #ffffff;">
            <div class="modal-header text-white d-flex justify-content-between align-items-center py-3" style="background-color: #1a365d;">
                <h5 class="modal-title fw-bold mb-0" id="modalReservationLabel">
                    <i class="ti ti-calendar-plus me-2" style="color: #f97316;"></i>Nouvelle demande de réservation
                </h5>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge px-2.5 py-1.5" style="background: #f97316; color: white; border-radius: 8px; font-size: 11px;">
                        EMS Voyage
                    </span>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <form method="POST" action="{{ url('/reservations/store') }}">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">

                        {{-- 1. Sélection du Client --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="color: #1e3a8a;">Client <span class="text-danger">*</span></label>
                            <select name="client_id" class="form-select" style="border-radius: 10px; border: 1px solid #d1d5db;" required>
                                <option value="" selected disabled>-- Choisir client --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">
                                        {{ $client->prenom ?? '' }} {{ $client->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- 2. Type de Voyage --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="color: #1e3a8a;">Type de voyage <span class="text-danger">*</span></label>
                            <select name="type_service" class="form-select" style="border-radius: 10px; border: 1px solid #d1d5db;" required>
                                <option value="" selected disabled>-- Choisir type --</option>
                                <option value="Aller simple">Aller simple</option>
                                <option value="Aller-Retour">Aller-Retour</option>
                            </select>
                        </div>

                        {{-- 3. Destination --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="color: #1e3a8a;">Destination <span class="text-danger">*</span></label>
                            <select name="destination" class="form-select" style="border-radius: 10px; border: 1px solid #d1d5db;" required>
                                <option value="" selected disabled>Choisir une destination...</option>
                                <option value="Dakar">Dakar</option>
                                <option value="Paris">Paris</option>
                                <option value="Ziguinchor">Ziguinchor</option>
                                <option value="Bamako">Bamako</option>
                                <option value="Casablanca">Casablanca</option>
                            </select>
                        </div>

                        {{-- 4. Classe de Voyage --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="color: #1e3a8a;">Classe de Voyage <span class="text-danger">*</span></label>
                            <select name="classe" class="form-select" style="border-radius: 10px; border: 1px solid #d1d5db;" required>
                                <option value="" selected disabled>Choisir la classe...</option>
                                <option value="Économique">Économique</option>
                                <option value="Business">Business</option>
                                <option value="Première">Première Class</option>
                            </select>
                        </div>

                        {{-- 5. Montant versé --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="color: #1e3a8a;">Montant versé (FCFA) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="montant" class="form-control" placeholder="Ex: 500000" style="border-radius: 10px; border: 1px solid #d1d5db;" required>
                        </div>

                        {{-- 6. Mode de Règlement --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="color: #1e3a8a;">Mode de Règlement <span class="text-danger">*</span></label>
                            <select name="mode_paiement" class="form-select" style="border-radius: 10px; border: 1px solid #d1d5db;" required>
                                <option value="" selected disabled>-- Choisir mode --</option>
                                <option value="Espèces">Espèces</option>
                                <option value="Carte">Carte</option>
                                <option value="Wave">Wave</option>
                                <option value="Orange Money">Orange Money</option>
                                <option value="Chèque">Chèque</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="modal-footer bg-light border-0 p-3">
                    <button type="button" class="btn btn-secondary fw-semibold px-4" data-bs-dismiss="modal" style="border-radius: 10px;">Fermer</button>
                    <button type="submit" class="btn text-white fw-bold px-4" style="background: linear-gradient(135deg, #1e3a8a, #2563eb); border-radius: 10px; border: none;">
                        Enregistrer la réservation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endsection

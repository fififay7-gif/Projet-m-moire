@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 style="color:#113366; font-weight:800; text-transform: uppercase; letter-spacing: 0.5px;">
            <i class="ti ti-layers-merge me-2" style="color: #FF6600;"></i>Liste des Versements
        </h3>

        <button type="button" class="btn text-white shadow-sm fw-bold" data-bs-toggle="modal" data-bs-target="#modalVersement" style="border-radius:8px; background-color: #FF6600; border: none; padding: 10px 20px;">
            <i class="ti ti-plus"></i> Nouveau Versement
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-3 text-white" style="background-color: #00A650;">{{ session('success') }}</div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning border-0 shadow-sm mb-3 text-dark" style="background-color: #FFE600;">{{ session('warning') }}</div>
    @endif

    <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden; border-top: 4px solid #113366;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #F4F7FA;">
                    <tr>
                        <th class="ps-4" style="color: #113366; font-weight: 700;">Réf Versement</th>
                        <th style="color: #113366; font-weight: 700;">Paiement / Client</th>
                        <th style="color: #113366; font-weight: 700;">Banque</th>
                        <th style="color: #113366; font-weight: 700;">Montant</th>
                        <th style="color: #113366; font-weight: 700;">Date de Versement</th>
                        <th style="color: #113366; font-weight: 700;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($versements as $versement)
                    <tr style="{{ $versement->trashed() ? 'opacity: 0.65; background-color: #f8f9fa;' : '' }}">
                        <td class="ps-4 fw-bold" style="color: #113366;">
                            {{ $versement->reference_versement ?? 'VER-' . $versement->id }}
                        </td>
                        <td>
                            @if($versement->trashed())
                                <span class="badge bg-danger text-white p-2" style="border-radius: 6px;">
                                    <i class="ti ti-trash-x me-1"></i> Ce versement a été supprimé
                                </span>
                            @else
                                <span class="badge bg-light text-dark border p-2" style="border-radius: 6px; border-left: 3px solid #113366 !important;">
                                    <i class="ti ti-file-text text-muted me-1"></i>
                                    @if($versement->paiement)
                                        Paiement N° {{ $versement->paiement_id }}
                                        @if($versement->paiement->client)
                                            - <strong style="color: #113366;">{{ $versement->paiement->client->nom }} {{ $versement->paiement->client->prenom ?? '' }}</strong>
                                        @else
                                            <span class="text-warning">(Pas de client lié)</span>
                                        @endif
                                    @else
                                        <span class="text-danger fw-bold">ID Paiement #{{ $versement->paiement_id }} introuvable</span>
                                    @endif
                                </span>
                            @endif
                        </td>
                        <td><span class="fw-semibold text-secondary">{{ $versement->banque }}</span></td>
                        <td class="fw-bold" style="color: #00A650;">{{ number_format($versement->montant, 0, ',', ' ') }} FCFA</td>
                        <td class="text-muted">
                            {{ $versement->date_versement ? \Carbon\Carbon::parse($versement->date_versement)->format('d/m/Y') : 'N/A' }}
                        </td>
                        <td class="text-center">
                            @if(!$versement->trashed())
                                <button type="button" class="btn btn-sm text-white me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $versement->id }}" style="background-color: #113366; border-radius: 6px;">
                                    Modifier
                                </button>
                                <button type="button"
        class="btn btn-sm text-white"
        style="background-color: #dc3545; border-radius: 6px;"
        data-bs-toggle="modal"
        data-bs-target="#deleteVersementModal{{ $versement->id }}">
    Supprimer
</button>
<div class="modal fade" id="deleteVersementModal{{ $versement->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">

      <div class="modal-body text-center pt-4 pb-3">
        <i class="ti ti-trash" style="font-size: 2.5rem; color: #1e3a8a;"></i>
        <h6 class="mt-3 fw-bold" style="color: #1e3a8a;">Suppression</h6>
        <p class="text-muted" style="font-size: 13px;">Voulez-vous vraiment supprimer ce versement ? Cette action est irréversible.</p>
      </div>

      <div class="modal-footer border-0 justify-content-center pt-0 pb-3">
        <button type="button" class="btn btn-light btn-sm px-3" style="border-radius: 8px;" data-bs-dismiss="modal">Annuler</button>

        <form action="{{ route('versements.destroy', $versement->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm px-3" style="border-radius: 8px; background-color: #f97316; color: white;">
                Confirmer
            </button>
        </form>
      </div>
    </div>
  </div>
</div>
                            @else
                                <span class="badge bg-secondary text-white fw-bold">Aucune action</span>
                            @endif
                        </td>
                    </tr>

                    @if(!$versement->trashed())
                    <div class="modal fade" id="editModal{{ $versement->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content" style="border-radius: 12px; border: none;">
                                <div class="modal-header text-white" style="background-color: #113366;">
                                    <h5 class="modal-title fw-bold">Modifier le Versement : {{ $versement->reference_versement }}</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('versements.update', $versement->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body p-4">

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="color:#113366;">Paiement / Client</label>
                                            <select name="paiement_id" class="form-select" style="border-radius:8px;" required>
                                                @foreach($paiements as $p)
                                                    <option value="{{ $p->id }}" {{ $versement->paiement_id == $p->id ? 'selected' : '' }}>
                                                        Paiement N° {{ $p->id }} @if($p->client) - {{ $p->client->nom }} {{ $p->client->prenom ?? '' }} @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="color:#113366;">Montant Versé (FCFA)</label>
                                            <input type="number" name="montant" class="form-control" value="{{ $versement->montant }}" min="0" style="border-radius:8px;" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="color:#113366;">Banque</label>
                                            <input type="text" name="banque" class="form-control" value="{{ $versement->banque }}" style="border-radius:8px;" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="color:#113366;">Date de versement</label>
                                            <input type="date" name="date_versement" class="form-control" value="{{ $versement->date_versement ? \Carbon\Carbon::parse($versement->date_versement)->format('Y-m-d') : date('Y-m-d') }}" style="border-radius:8px;" required>
                                        </div>

                                    </div>
                                    <div class="modal-footer bg-light">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius:8px;">Fermer</button>
                                        <button type="submit" class="btn text-white" style="background-color: #FF6600; border: none; border-radius:8px;">Enregistrer les modifications</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="ti ti-alert-circle d-block fs-2 mb-2" style="color: #FF6600;"></i>
                            Aucun versement enregistré pour le moment.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalVersement" tabindex="-1" aria-labelledby="modalVersementLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none;">
            <div class="modal-header text-white" style="background-color: #113366; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <h5 class="modal-title fw-bold" id="modalVersementLabel">
                    <i class="ti ti-wallet me-2" style="color: #FF6600;"></i>Nouveau Versement EMS
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('versements.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color:#113366;">Sélectionner le Paiement / Client</label>
                        <select name="paiement_id" class="form-select" style="border-radius:8px;" required>
                            <option value="">-- Choisir le paiement d'un client --</option>
                            @foreach($paiements as $p)
                                <option value="{{ $p->id }}">
                                    Paiement N° {{ $p->id }} @if($p->client) - Client : {{ $p->client->nom }} {{ $p->client->prenom ?? '' }} @endif - [{{ number_format($p->montant, 0, ',', ' ') }} FCFA]
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color:#113366;">Montant Versé (FCFA)</label>
                        <input type="number" name="montant" class="form-control" placeholder="Ex: 500000" min="0" style="border-radius:8px;" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color:#113366;">Banque</label>
                        <input type="text" name="banque" class="form-control" placeholder="Ex: CBAO..." style="border-radius:8px;" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color:#113366;">Date de versement</label>
                        <input type="date" name="date_versement" class="form-control" style="border-radius:8px;" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">Fermer</button>
                    <button type="submit" class="btn text-white fw-bold" style="background-color: #FF6600; border: none; border-radius: 8px; padding: 8px 20px;">Ajouter le versement</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

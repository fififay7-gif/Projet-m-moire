@extends('layouts.app')

@section('content')
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm" style="border-radius: 12px;">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 style="color: #1e3a8a; font-weight: 800;">Gestion des Paiements</h3>
        <button type="button" class="btn btn-success shadow-sm fw-bold px-4" data-bs-toggle="modal" data-bs-target="#modalCreate" style="border-radius: 10px;">
            <i class="ti ti-plus"></i> Nouveau Paiement
        </button>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 16px; overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Réf</th>
                        <th>Date</th>
                        <th>Client</th>
                        <th>Mode</th>
                        <th>Montant</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paiements as $paiement)
                    <tr>
                        <td class="ps-4 fw-bold text-primary">#PAY-{{ $paiement->id }}</td>
                        <td>{{ $paiement->created_at->format('d/m/Y') }}</td>
                        <td>{{ $paiement->client->prenom ?? '' }} {{ $paiement->client->nom ?? 'Inconnu' }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $paiement->mode_paiement }}</span></td>
                        <td class="fw-bold text-dark">{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
                        <td class="text-center">
                            <div class="btn-group gap-1">
                                <a href="{{ route('comptable.paiements.bordereau', $paiement->id) }}" class="btn btn-sm btn-outline-info" title="Imprimer">
                                    <i class="ti ti-printer"></i>
                                </a>
                                <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $paiement->id }}" title="Modifier">
                                    <i class="ti ti-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $paiement->id }}" title="Supprimer">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal{{ $paiement->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content" style="border-radius: 15px;">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title fw-bold text-primary">Modifier Paiement #{{ $paiement->id }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('paiements.update', $paiement->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Montant (FCFA)</label>
                                            <input type="number" name="montant" class="form-control" value="{{ $paiement->montant }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Mode de paiement</label>
                                            <select name="mode_paiement" class="form-select" required>
                                                @foreach(['Espèces', 'Orange Money', 'Wave', 'Carte Bancaire', 'Chèque'] as $mode)
                                                    <option value="{{ $mode }}" {{ $paiement->mode_paiement == $mode ? 'selected' : '' }}>{{ $mode }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0 p-4">
                                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">Enregistrer les modifications</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteModal{{ $paiement->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm">
                            <div class="modal-content" style="border-radius: 15px;">
                                <div class="modal-body text-center p-4">
                                    <div class="text-danger mb-3"><i class="ti ti-alert-triangle fs-1"></i></div>
                                    <h5 class="fw-bold">Supprimer ?</h5>
                                    <p class="text-muted small">Voulez-vous vraiment supprimer le paiement #{{ $paiement->id }} ?</p>
                                    <form action="{{ route('paiements.destroy', $paiement->id) }}" method="POST" class="d-flex justify-content-center gap-2 mt-3">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Non</button>
                                        <button type="submit" class="btn btn-danger px-4">Oui, Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header border-0 bg-primary text-white" style="border-radius: 15px 15px 0 0;">
                <h5 class="modal-title fw-bold">Nouveau Paiement</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('paiements.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-primary">Client</label>
                        <select name="client_id" class="form-select shadow-none" required>
                            <option value="">Sélectionner un client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->prenom }} {{ $client->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-primary">Montant (FCFA)</label>
                        <input type="number" name="montant" class="form-control" placeholder="0" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-primary">Mode de paiement</label>
                        <select name="mode_paiement" class="form-select" required>
                            <option value="Espèces">Espèces</option>
                            <option value="Orange Money">Orange Money</option>
                            <option value="Wave">Wave</option>
                            <option value="Carte Bancaire">Carte Bancaire</option>
                            <option value="Chèque">Chèque</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">Valider le paiement</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

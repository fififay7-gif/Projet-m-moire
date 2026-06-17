@extends('layouts.app')

@section('content')

<style>
    :root{
        --ems-blue:#1e3a8a;
        --ems-orange:#ff7a00;
    }

    .text-ems{
        color: var(--ems-blue);
    }

    .bg-ems{
        background: var(--ems-blue);
        color: white;
    }

    .btn-ems{
        background: var(--ems-orange);
        color: white;
        border: none;
        font-weight: 600;
    }

    .btn-ems:hover{
        background: #e66d00;
        color: white;
    }

    .card{
        border-radius:16px;
    }

    .table thead th{
        background: var(--ems-blue);
        color:white;
        border:none;
        padding:15px;
    }

    .table tbody tr:hover{
        background:#f8f9fa;
    }

    .badge-mode{
        background:#eef2ff;
        color:var(--ems-blue);
        border:1px solid #dbeafe;
        padding:6px 10px;
        border-radius:8px;
    }

    .montant{
        color:#198754;
        font-weight:bold;
    }

    .modal-content{
        border:none;
        border-radius:15px;
    }
</style>

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success shadow-sm border-0">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-ems">
            Gestion des Paiements
        </h3>

        <button type="button"
                class="btn btn-ems shadow-sm px-4"
                data-bs-toggle="modal"
                data-bs-target="#modalCreate">
            <i class="ti ti-plus"></i>
            Nouveau Paiement
        </button>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th>Référence</th>
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

                        <td class="fw-bold text-ems">
                            #PAY-{{ $paiement->id }}
                        </td>

                        <td>
                            {{ $paiement->created_at->format('d/m/Y') }}
                        </td>

                        <td>
                            {{ $paiement->client->prenom ?? '' }}
                            {{ $paiement->client->nom ?? 'Inconnu' }}
                        </td>

                        <td>
                            <span class="badge-mode">
                                {{ $paiement->mode_paiement }}
                            </span>
                        </td>

                        <td class="montant">
                            {{ number_format($paiement->montant,0,',',' ') }}
                            FCFA
                        </td>

                        <td class="text-center">

                            <a href="{{ route('comptable.paiements.bordereau',$paiement->id) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="ti ti-printer"></i>
                            </a>

                            <button class="btn btn-sm btn-outline-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $paiement->id }}">
                                <i class="ti ti-edit"></i>
                            </button>

                            <button class="btn btn-sm btn-outline-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $paiement->id }}">
                                <i class="ti ti-trash"></i>
                            </button>

                        </td>

                    </tr>

                    <!-- MODAL MODIFIER -->

                    <div class="modal fade"
                         id="editModal{{ $paiement->id }}"
                         tabindex="-1">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <div class="modal-header bg-ems">
                                    <h5 class="modal-title">
                                        Modifier Paiement #{{ $paiement->id }}
                                    </h5>

                                    <button type="button"
                                            class="btn-close btn-close-white"
                                            data-bs-dismiss="modal">
                                    </button>
                                </div>

                                <form action="{{ route('paiements.update',$paiement->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('PUT')

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label class="form-label fw-bold text-ems">
                                                Montant
                                            </label>

                                            <input type="number"
                                                   name="montant"
                                                   value="{{ $paiement->montant }}"
                                                   class="form-control"
                                                   required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold text-ems">
                                                Mode de paiement
                                            </label>

                                            <select name="mode_paiement"
                                                    class="form-select">

                                                <option value="Espèces">Espèces</option>
                                                <option value="Orange Money">Orange Money</option>
                                                <option value="Wave">Wave</option>
                                                <option value="Carte Bancaire">Carte Bancaire</option>
                                                <option value="Chèque">Chèque</option>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="modal-footer">

                                        <button type="submit"
                                                class="btn btn-ems">
                                            Enregistrer
                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                    <!-- MODAL SUPPRESSION -->

                    <div class="modal fade"
                         id="deleteModal{{ $paiement->id }}"
                         tabindex="-1">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <div class="modal-body text-center p-4">

                                    <h5 class="text-danger">
                                        Supprimer ?
                                    </h5>

                                    <p>
                                        Voulez-vous supprimer ce paiement ?
                                    </p>

                                    <form action="{{ route('paiements.destroy',$paiement->id) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                                class="btn btn-secondary"
                                                data-bs-dismiss="modal">
                                            Annuler
                                        </button>

                                        <button type="submit"
                                                class="btn btn-danger">
                                            Supprimer
                                        </button>

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

<!-- MODAL AJOUT -->

<div class="modal fade"
     id="modalCreate"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-ems">

                <h5 class="modal-title">
                    Nouveau Paiement
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <form action="{{ route('paiements.store') }}"
                  method="POST">

                @csrf

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label fw-bold text-ems">
                            Client
                        </label>

                        <select name="client_id"
                                class="form-select"
                                required>

                            <option value="">
                                Sélectionner un client
                            </option>

                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">
                                    {{ $client->prenom }}
                                    {{ $client->nom }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label fw-bold text-ems">
                            Montant
                        </label>

                        <input type="number"
                               name="montant"
                               class="form-control"
                               required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label fw-bold text-ems">
                            Mode de paiement
                        </label>

                        <select name="mode_paiement"
                                class="form-select"
                                required>

                            <option value="Espèces">Espèces</option>
                            <option value="Orange Money">Orange Money</option>
                            <option value="Wave">Wave</option>
                            <option value="Carte Bancaire">Carte Bancaire</option>
                            <option value="Chèque">Chèque</option>

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit"
                            class="btn btn-ems w-100">
                        Valider le paiement
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>

@endsection

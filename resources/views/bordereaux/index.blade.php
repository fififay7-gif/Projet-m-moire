@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 style="color:#0f2a6b;font-weight:bold;">
            Gestion des Bordereaux
        </h2>

        <button class="btn text-white"
                style="background:#f97316;border:none;"
                data-bs-toggle="modal"
                data-bs-target="#modalBordereau">

             Générer un Bordereau

        </button>

    </div>

    <div class="card shadow border-0">

        <div class="card-header text-white"
             style="background:linear-gradient(135deg,#0f2a6b,#2563eb);">

            <h5 class="mb-0">
                Liste des Bordereaux
            </h5>

        </div>

        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">

                <thead style="background:#eaf1ff;">

                    <tr>
                        <th>Code</th>
                        <th>Date de Création</th>
                        <th>Statut</th>
                        <th>Agent</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($bordereaux as $item)

                    <tr>

                        <td class="fw-bold text-primary">
                            {{ $item->code_bordereau }}
                        </td>

                        <td>
                            {{ $item->date_creation }}
                        </td>

                        <td>

                            @if($item->statut == 'en_attente')

                                <span class="badge bg-warning text-dark">
                                    En attente
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Validé
                                </span>

                            @endif

                        </td>

                        <td>
                            {{ $item->user->name ?? 'N/A' }}
                        </td>

                        <td>

                            <button class="btn btn-sm text-white"
                                    style="background:#2563eb;">
                                 Voir
                            </button>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5" class="text-center py-4 text-muted">
                            Aucun bordereau trouvé.
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- MODAL -->

<div class="modal fade" id="modalBordereau" tabindex="-1">

    <div class="modal-dialog">

        <form action="{{ route('bordereaux.store') }}"
              method="POST"
              class="modal-content border-0 shadow">

            @csrf

            <div class="modal-header text-white"
                 style="background:linear-gradient(135deg,#0f2a6b,#2563eb);">

                <h5 class="modal-title">
                    Nouveau Bordereau
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Observations (Optionnel)
                    </label>

                    <textarea name="observations"
                              class="form-control"
                              rows="4"
                              placeholder="Saisir une observation..."></textarea>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                    Annuler

                </button>

                <button type="submit"
                        class="btn text-white"
                        style="background:#f97316;">

                     Confirmer la création

                </button>

            </div>

        </form>

    </div>

</div>

@endsection

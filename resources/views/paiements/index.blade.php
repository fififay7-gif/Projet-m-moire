@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 style="color: #1e3a8a; font-weight: 800;">
             Gestion des Paiements
        </h3>

        <button class="btn fw-bold px-4 py-2"
                data-bs-toggle="modal"
                data-bs-target="#paiementModal"
                style="background: linear-gradient(135deg, #1e3a8a, #2563eb);
                       color: white;
                       border-radius: 12px;">
            + Nouveau paiement
        </button>

    </div>

    <!-- TABLE CARD -->
    <div class="card shadow-sm border-0"
         style="border-radius: 16px; overflow: hidden;">

        <div class="card-header text-white"
             style="background: #1e3a8a; font-weight: 600;">
            Liste des paiements
        </div>

        <div class="card-body table-responsive p-0">

            <table class="table table-hover align-middle mb-0">

                <thead style="background: #f4f7ff;">
                    <tr style="color:#1e3a8a;">
                        <th>#</th>
                        <th>Client</th>
                        <th>Montant</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($paiements as $paiement)
                        <tr>

                            <td style="font-weight:600; color:#1e3a8a;">
                                {{ $paiement->id }}
                            </td>

                            <td>
                                {{ $paiement->client->nom ?? 'N/A' }}
                            </td>

                            <td style="color:#10b981; font-weight:700;">
                                {{ number_format($paiement->montant, 0, ',', ' ') }} FCFA
                            </td>

                            <td>
                                {{ $paiement->created_at }}
                            </td>

                        </tr>
                    @empty

                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                Aucun paiement enregistré
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- ================= MODAL EMS ================= -->
<div class="modal fade" id="paiementModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content"
             style="border-radius: 16px; overflow: hidden;">

            <!-- HEADER MODAL -->
            <div class="modal-header text-white"
                 style="background: linear-gradient(135deg, #1e3a8a, #2563eb);">

                <h5 class="modal-title fw-bold">
                     Nouveau Paiement
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <form action="{{ route('paiements.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                    <!-- CLIENT -->
                    <div class="mb-3">
                        <label style="font-weight:600; color:#1e3a8a;">
                            Client
                        </label>

                        <select name="client_id"
                                class="form-control"
                                style="border-radius: 10px;"
                                required>

                            <option value="">-- Choisir un client --</option>

                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">
                                    {{ $client->nom }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- MONTANT -->
                    <div class="mb-3">
                        <label style="font-weight:600; color:#1e3a8a;">
                            Montant payé (FCFA)
                        </label>

                        <input type="number"
                               name="montant"
                               class="form-control"
                               style="border-radius: 10px;"
                               required>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Fermer
                    </button>

                    <button type="submit"
                            class="btn fw-bold"
                            style="background: linear-gradient(135deg, #10b981, #059669);
                                   color: white;">
                        Enregistrer
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection

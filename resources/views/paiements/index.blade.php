@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>Gestion des Paiements</h3>

        <!-- BOUTON OUVRIR MODAL -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paiementModal">
             Nouveau paiement
        </button>

    </div>

    <!-- ================= TABLE ================= -->
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            Liste des paiements
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Facture</th>
                        <th>Montant</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
@forelse($paiements as $paiement)
    <tr>
        <td>{{ $paiement->id }}</td>
        <td>{{ $paiement->client->name ?? 'N/A' }}</td>
        <td>{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
        <td>{{ $paiement->created_at }}</td>
    </tr>
@empty
    <tr>
        <td colspan="4" class="text-center">Aucun paiement</td>
    </tr>
@endforelse
</tbody>
            </table>

        </div>
    </div>

</div>

<!-- ================= MODAL ================= -->
<div class="modal fade" id="paiementModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Nouveau Paiement</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('paiements.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                    <!-- CLIENT -->
                    <div class="mb-3">
                        <label class="form-label">Client</label>

                        <select name="client_id" class="form-control" required>
                            <option value="">-- Choisir un client --</option>

                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">
                                    {{ $client->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- MONTANT -->
                    <div class="mb-3">
                        <label class="form-label">Montant payé</label>
                        <input type="number"
                               name="montant"
                               class="form-control"
                               required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Fermer
                    </button>

                    <button type="submit" class="btn btn-success">
                        Enregistrer
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>
@endsection

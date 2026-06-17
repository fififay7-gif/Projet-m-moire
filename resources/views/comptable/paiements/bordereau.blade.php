@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow p-5">
        <h2 class="text-uppercase text-primary fw-bold">Bordereau de Paiement</h2>
        <hr>

        <div class="row">
            <div class="col-6">
                <p><strong>REÇU DE :</strong> {{ $paiement->client->nom }} {{ $paiement->client->prenom }}</p>
            </div>
            <div class="col-6 text-end">
                <p><strong>DATE :</strong> {{ $paiement->date_paiement }}</p>
            </div>
        </div>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Mode de Règlement</th>
                    <th>Montant Versé</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $paiement->mode_paiement }}</td>
                    <td class="fw-bold">{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
                </tr>
            </tbody>
        </table>

        <div class="text-center mt-4 no-print">
            <button onclick="window.print()" class="btn btn-primary">Imprimer le bordereau</button>
            <a href="{{ route('paiements.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection

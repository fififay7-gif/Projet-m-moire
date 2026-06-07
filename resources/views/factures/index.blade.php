@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between mb-4">
        <h3>Gestion des Factures</h3>
        <a href="/factures/create" class="btn btn-primary">
            + Nouvelle facture
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">

            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>N° Facture</th>
                        <th>Client</th>
                        <th>Montant</th>
                        <th>Payé</th>
                        <th>Reste</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($factures as $f)
                        <tr>
                            <td>{{ $f->numero_facture }}</td>
                            <td>{{ $f->client->nom }}</td>

                            <td>{{ $f->montant }} FCFA</td>
                            <td>{{ $f->montant_paye }} FCFA</td>
                            <td>{{ $f->reste_a_payer }} FCFA</td>

                            <td>
                                @if($f->statut == 'impayee')
                                    <span class="badge bg-danger">Impayée</span>
                                @elseif($f->statut == 'partielle')
                                    <span class="badge bg-warning">Partielle</span>
                                @else
                                    <span class="badge bg-success">Payée</span>
                                @endif
                            </td>

                            <td>{{ $f->date_facture }}</td>

                            <td>
                                <a href="/factures/{{ $f->id }}" class="btn btn-info btn-sm">
                                    Voir
                                    <a href="/factures/{{ $facture->id }}/pdf" class="btn btn-danger btn-sm">
    PDF
</a>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection

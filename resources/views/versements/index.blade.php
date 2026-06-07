@extends('layouts.app')

@section('content')

<div class="card">

    <h2>Liste des Versements</h2>

    <a href="{{ route('versements.create') }}">
        Nouveau Versement
    </a>

    <br><br>

    <table border="1" width="100%" cellpadding="10">

        <thead>
            <tr>
                <th>ID</th>
                <th>Bordereau</th>
                <th>Montant</th>
                <th>Banque</th>
                <th>Date de versement</th>
            </tr>
        </thead>

        <tbody>

            @forelse($versements as $versement)

                <tr>

                    <td>{{ $versement->id }}</td>

                    <td>{{ $versement->bordereau_id }}</td>

                    <td>{{ number_format($versement->montant, 0, ',', ' ') }} FCFA</td>

                    <td>{{ $versement->banque }}</td>

                    <td>{{ $versement->date_versement }}</td>

                </tr>

            @empty

                <tr>
                    <td colspan="5">
                        Aucun versement enregistré
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection

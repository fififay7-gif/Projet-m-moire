@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Gestion des Réservations</h3>
        <a href="/reservations/create" class="btn btn-primary">
            + Nouvelle réservation
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">

            <table class="table table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Client</th>
                        <th>Service</th>
                        <th>Description</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($reservations as $r)
                        <tr>
                            <td>{{ $r->client->nom }}</td>
                            <td>{{ $r->type_service }}</td>
                            <td>{{ $r->description }}</td>

                            <td>
                                @if($r->statut == 'en_attente')
                                    <span class="badge bg-warning">En attente</span>
                                @elseif($r->statut == 'validee')
                                    <span class="badge bg-success">Validée</span>
                                @elseif($r->statut == 'rejetee')
                                    <span class="badge bg-danger">Rejetée</span>
                                @else
                                    <span class="badge bg-info">Terminée</span>
                                @endif
                            </td>

                            <td>{{ $r->date_reservation }}</td>

                            <td class="d-flex gap-2">

                                <a href="/reservations/{{ $r->id }}/validee"
                                   class="btn btn-success btn-sm">
                                    ✔
                                </a>

                                <a href="/reservations/{{ $r->id }}/rejetee"
                                   class="btn btn-danger btn-sm">
                                    ✖
                                </a>

                                <form action="/reservations/{{ $r->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-dark btn-sm">
                                        🗑
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection

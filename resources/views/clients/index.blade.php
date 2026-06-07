@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h3>Gestion des Clients</h3>
        <a href="/clients/create" class="btn btn-primary">+ Ajouter</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped shadow">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($clients as $client)
            <tr>
                <td>{{ $client->nom }}</td>
                <td>{{ $client->telephone }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->adresse }}</td>
                <td>
                    <form method="POST" action="/clients/{{ $client->id }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection

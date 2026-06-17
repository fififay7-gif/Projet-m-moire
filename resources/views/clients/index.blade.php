@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="color:#0f2a6b;font-weight:bold;">Gestion des Clients</h2>
        <button type="button" class="btn text-white" style="background:#f97316;" data-bs-toggle="modal" data-bs-target="#addClientModal">
            Ajouter un Client
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card shadow border-0">
        <table class="table table-hover align-middle mb-0">
            <thead style="background:#eaf1ff;">
                <tr><th>Nom</th><th>Prénom</th><th>Téléphone</th><th>Email</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td class="fw-bold">{{ $client->nom }}</td>
                    <td>{{ $client->prenom }}</td>
                    <td>{{ $client->telephone }}</td>
                    <td>{{ $client->email }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editClientModal{{ $client->id }}">
                                Modifier
                            </button>
                            <form method="POST" action="{{ route('clients.destroy', $client->id) }}" onsubmit="return confirm('Confirmer ?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>

                <div class="modal fade" id="editClientModal{{ $client->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('clients.update', $client->id) }}">
                                @csrf @method('PUT')
                                <div class="modal-header"><h5 class="modal-title">Modifier {{ $client->nom }}</h5></div>
                                <div class="modal-body">
                                    <input type="text" name="nom" class="form-control mb-2" value="{{ $client->nom }}" required>
                                    <input type="text" name="prenom" class="form-control mb-2" value="{{ $client->prenom }}" required>
                                    <input type="text" name="telephone" class="form-control mb-2" value="{{ $client->telephone }}">
                                    <input type="email" name="email" class="form-control mb-2" value="{{ $client->email }}">
                                </div>
                                <div class="modal-footer"><button type="submit" class="btn btn-success">Enregistrer</button></div>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <tr><td colspan="5" class="text-center py-4">Aucun client.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addClientModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('clients.store') }}">
                @csrf
                <div class="modal-header"><h5 class="modal-title">Ajouter un Client</h5></div>
                <div class="modal-body">
                    <input type="text" name="nom" class="form-control mb-2" placeholder="Nom" required>
                    <input type="text" name="prenom" class="form-control mb-2" placeholder="Prénom" required>
                    <input type="text" name="telephone" class="form-control mb-2" placeholder="Téléphone">
                    <input type="email" name="email" class="form-control mb-2" placeholder="Email">
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Enregistrer</button></div>
            </form>
        </div>
    </div>
</div>
@endsection

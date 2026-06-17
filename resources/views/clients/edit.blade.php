@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow border-0" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header text-white" style="background: linear-gradient(135deg, #0f2a6b, #2563eb);">
            <h5 class="mb-0">Modifier le Client : {{ $client->prenom }} {{ $client->nom }}</h5>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="/clients/{{ $client->id }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold" style="color: #0f2a6b;">Nom</label>
                    <input type="text" name="nom" class="form-control" value="{{ old('nom', $client->nom) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold" style="color: #0f2a6b;">Prénom</label>
                    <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $client->prenom) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold" style="color: #0f2a6b;">Téléphone</label>
                    <input type="text" name="telephone" class="form-control" value="{{ old('telephone', $client->telephone) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold" style="color: #0f2a6b;">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $client->email) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold" style="color: #0f2a6b;">Adresse</label>
                    <input type="text" name="adresse" class="form-control" value="{{ old('adresse', $client->adresse) }}">
                </div>

                <div class="d-flex gap-2 justify-content-end mt-4">
                    <a href="/clients" class="btn btn-light border">Annuler</a>
                    <button type="submit" class="btn text-white" style="background: #f97316; border: none;">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

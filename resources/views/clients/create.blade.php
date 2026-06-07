@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card shadow p-4">

        <h3 class="mb-4">➕ Ajouter un client</h3>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="/clients/store">
            @csrf

            <div class="mb-3">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Prénom</label>
                <input type="text" name="prenom" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Téléphone</label>
                <input type="text" name="telephone" class="form-control">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label>Adresse</label>
                <input type="text" name="adresse" class="form-control">
            </div>

            <button class="btn btn-primary">
                Enregistrer
            </button>

            <a href="/clients" class="btn btn-secondary">
                Retour
            </a>

        </form>

    </div>

</div>

@endsection

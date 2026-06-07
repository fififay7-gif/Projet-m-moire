@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Nouveau Paiement
        </div>

        <div class="card-body">

            <form action="{{ route('paiements.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>clients</label>

                  <select name="client_id" class="form-control" required>
    <option value="">-- Choisir un client --</option>

    @foreach($clients as $client)
        <option value="{{ $client->id }}">
            {{ $client->name }}
        </option>
    @endforeach
</select>
                </div>

                <div class="mb-3">
                    <label>Montant payé</label>
                    <input type="number"
                           step="0.01"
                           name="montant"
                           class="form-control"
                           required>
                </div>

                <button type="submit" class="btn btn-success">
                    Enregistrer
                </button>

            </form>

        </div>
    </div>
</div>

@endsection

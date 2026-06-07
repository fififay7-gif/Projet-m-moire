@extends('layouts.app')

@section('content')

<div class="container">

    <h3 class="mb-4">Créer une Facture</h3>

    <div class="card shadow">
        <div class="card-body">

            <form method="POST" action="/factures/store">
                @csrf

                <div class="mb-3">
                    <label>Client</label>
                    <select name="client_id" class="form-control" required>
                        <option value="">-- Choisir client --</option>

                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">
                                {{ $client->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Réservation (optionnel)</label>
                    <select name="reservation_id" class="form-control">
                        <option value="">Aucune</option>

                        @foreach($reservations as $r)
                            <option value="{{ $r->id }}">
                                {{ $r->type_service }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Montant</label>
                    <input type="number" name="montant" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Date facture</label>
                    <input type="date" name="date_facture" class="form-control" required>
                </div>

                <button class="btn btn-primary w-100">
                    Générer facture
                </button>

            </form>

        </div>
    </div>

</div>

@endsection

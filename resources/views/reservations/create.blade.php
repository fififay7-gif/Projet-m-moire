@extends('layouts.app')

@section('content')

<div class="container">

    <h3 class="mb-4">Nouvelle Réservation</h3>

    <div class="card shadow">
        <div class="card-body">

            <form method="POST" action="/reservations/store">
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

                <select name="type_voyage" required>
    <option value="Billet Avion">Billet Avion</option>
    <option value="Omra">Omra</option>
    <option value="Ziarra">Ziarra</option>
    <option value="Tourisme">Tourisme</option>
</select>


                <div class="mb-3">
                    <label>Date</label>
                    <input type="date" name="date_reservation" class="form-control">
                </div>

                <button class="btn btn-primary w-100">
                    Enregistrer
                </button>

            </form>

        </div>
    </div>

</div>

@endsection

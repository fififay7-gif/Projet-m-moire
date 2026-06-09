@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 style="color: #1e3a8a; font-weight: 800;">
             Nouveau Paiement
        </h3>

        <span class="badge px-3 py-2 fs-6"
              style="background: #f97316; color: white; border-radius: 12px;">
            EMS Voyage : Encaissement
        </span>
    </div>

    <!-- CARD FORM -->
    <div class="card shadow-sm border-0 p-4"
         style="border-radius: 16px; background: #ffffff;">

        <form action="{{ route('paiements.store') }}" method="POST">
            @csrf

            <!-- CLIENT -->
            <div class="mb-3">
                <label style="font-weight:600; color:#1e3a8a;">
                    Client
                </label>

                <select name="client_id"
                        class="form-control"
                        style="border-radius: 10px; border: 1px solid #d1d5db;"
                        required>

                    <option value="">-- Choisir un client --</option>

                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">
                            {{ $client->nom }}
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- MONTANT -->
            <div class="mb-3">
                <label style="font-weight:600; color:#1e3a8a;">
                    Montant payé (FCFA)
                </label>

                <input type="number"
                       step="0.01"
                       name="montant"
                       class="form-control"
                       style="border-radius: 10px; border: 1px solid #d1d5db;"
                       required>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="btn w-100 fw-bold"
                    style="background: linear-gradient(135deg, #10b981, #059669);
                           color: white;
                           padding: 12px;
                           border-radius: 12px;">
                 Enregistrer le paiement
            </button>

        </form>

    </div>

</div>

@endsection

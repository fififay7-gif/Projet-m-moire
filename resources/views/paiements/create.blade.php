@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 style="color: #1e3a8a; font-weight: 800;">
             Nouveau Paiement
        </h3>

        <span class="badge px-3 py-2 fs-6"
              style="background: #f97316; color: white; border-radius: 12px;">
            EMS Voyage : Encaissement
        </span>
    </div>

    <div class="card shadow-sm border-0 p-4"
         style="border-radius: 16px; background: #ffffff;">

        <form action="{{ route('paiements.store') }}" method="POST">
            @csrf

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
                            {{ $client->prenom ?? '' }} {{ $client->nom }}
                        </option>
                    @endforeach

                </select>
            </div>

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

            <div class="mb-4">
                <label style="font-weight:600; color:#1e3a8a;">
                    Mode de Règlement
                </label>

                <select name="mode_paiement"
                        class="form-control"
                        style="border-radius: 10px; border: 1px solid #d1d5db;"
                        required>
                    <option value="">-- Choisir le mode de paiement --</option>
                    <option value="Espèces">Espèces</option>
                    <option value="Wave">Wave</option>
                    <option value="Orange Money">Orange Money</option>
                    <option value="Chèque">Chèque</option>
                    <option value="Virement Bancaire">Virement Bancaire</option>
                </select>
            </div>

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

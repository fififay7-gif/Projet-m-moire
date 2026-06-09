@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 style="color: #1e3a8a; font-weight: 800;">
             Créer une Facture
        </h3>

        <span class="badge px-3 py-2 fs-6"
              style="background: #f97316; color: white; border-radius: 12px;">
            EMS Voyage : Facturation
        </span>
    </div>

    <!-- FORM CARD -->
    <div class="card shadow-sm border-0 p-4"
         style="border-radius: 16px; background: #ffffff;">

        <form method="POST" action="/factures/store">
            @csrf

            <!-- CLIENT -->
            <div class="mb-3">
                <label style="font-weight:600; color:#1e3a8a;">Client</label>

                <select name="client_id"
                        class="form-control"
                        style="border-radius: 10px; border: 1px solid #d1d5db;"
                        required>
                    <option value="">-- Choisir client --</option>

                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">
                            {{ $client->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- RESERVATION -->
            <div class="mb-3">
                <label style="font-weight:600; color:#1e3a8a;">
                    Réservation (optionnel)
                </label>

                <select name="reservation_id"
                        class="form-control"
                        style="border-radius: 10px; border: 1px solid #d1d5db;">
                    <option value="">Aucune</option>

                    @foreach($reservations as $r)
                        <option value="{{ $r->id }}">
                            {{ $r->type_service }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- MONTANT -->
            <div class="mb-3">
                <label style="font-weight:600; color:#1e3a8a;">Montant (FCFA)</label>

                <input type="number"
                       name="montant"
                       class="form-control"
                       style="border-radius: 10px; border: 1px solid #d1d5db;"
                       required>
            </div>

            <!-- DATE -->
            <div class="mb-3">
                <label style="font-weight:600; color:#1e3a8a;">Date facture</label>

                <input type="date"
                       name="date_facture"
                       class="form-control"
                       style="border-radius: 10px; border: 1px solid #d1d5db;"
                       required>
            </div>

            <!-- BUTTON -->
            <button class="btn w-100 fw-bold"
                    style="background: linear-gradient(135deg, #1e3a8a, #2563eb);
                           color: white;
                           padding: 12px;
                           border-radius: 12px;">
                 Générer la facture
            </button>

        </form>

    </div>

</div>

@endsection

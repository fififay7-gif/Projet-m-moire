@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 style="color: #1e3a8a; font-weight: 800;">
             Nouvelle Réservation
        </h3>

        <span class="badge px-3 py-2 fs-6"
              style="background: #f97316; color: white; border-radius: 12px;">
            EMS Voyage : Réservations
        </span>

    </div>

    <!-- FORM CARD -->
    <div class="card shadow-sm border-0 p-4"
         style="border-radius: 16px; background: #ffffff;">

        <form method="POST" action="/reservations/store">
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

                    <option value="">-- Choisir client --</option>

                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">
                            {{ $client->nom }}
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- TYPE VOYAGE -->
            <div class="mb-3">
                <label style="font-weight:600; color:#1e3a8a;">
                    Type de voyage
                </label>

                <select name="type_voyage"
                        class="form-control"
                        style="border-radius: 10px; border: 1px solid #d1d5db;"
                        required>

                    <option value="">-- Choisir type --</option>
                    <option value="Billet Avion"> Billet Avion</option>
                    <option value="Omra"> Omra</option>
                    <option value="Ziarra"> Ziarra</option>
                    <option value="Tourisme"> Tourisme</option>

                </select>
            </div>

            <!-- DATE -->
            <div class="mb-3">
                <label style="font-weight:600; color:#1e3a8a;">
                    Date de réservation
                </label>

                <input type="date"
                       name="date_reservation"
                       class="form-control"
                       style="border-radius: 10px; border: 1px solid #d1d5db;">
            </div>

            <!-- BUTTON -->
            <button class="btn w-100 fw-bold"
                    style="background: linear-gradient(135deg, #1e3a8a, #2563eb);
                           color: white;
                           padding: 12px;
                           border-radius: 12px;">
                 Enregistrer la réservation
            </button>

        </form>

    </div>

</div>

@endsection

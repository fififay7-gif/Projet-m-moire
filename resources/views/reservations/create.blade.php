@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 style="color: #1e3a8a; font-weight: 800;">
             Nouvelle Réservation
        </h3>

        <span class="badge px-3 py-2 fs-6"
              style="background: #f97316; color: white; border-radius: 12px;">
            EMS Voyage : Réservations
        </span>
    </div>

    <div class="card shadow-sm border-0 p-4"
         style="border-radius: 16px; background: #ffffff;">

        <form method="POST" action="/reservations/store">
            @csrf

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
                            {{ $client->prenom ?? '' }} {{ $client->nom }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-3">
                <label style="font-weight:600; color:#1e3a8a;">
                    Type de voyage
                </label>

                <select name="type_service"
                        class="form-control"
                        style="border-radius: 10px; border: 1px solid #d1d5db;"
                        required>
                    <option value="">-- Choisir type --</option>
                    <option value="Aller simple">Aller simple</option>
                    <option value="Aller-Retour">Aller-Retour</option>
                </select>
            </div>

            <div class="mb-3">
                <label style="font-weight:600; color:#1e3a8a;">
                    Montant versé (FCFA)
                </label>
                <input type="number"
                       step="0.01"
                       name="montant"
                       class="form-control"
                       placeholder="Ex: 500000"
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
                    <option value="">-- Choisir mode --</option>
                    <option value="Espèces">Espèces</option>
                    <option value="Carte">Carte</option>
                    <option value="Wave">Wave</option>
                    <option value="Orange Money">Orange Money</option>
                    <option value="Chèque">Chèque</option>
                </select>
            </div>
            {{-- Champ Destination --}}
<div class="mb-3">
    <label class="form-label fw-semibold" style="color:#1a365d;">Destination</label>
    <select name="destination" class="form-select" style="border-radius:8px;" required>
        <option value="" selected disabled>Choisir une destination...</option>
        <option value="Dakar">Dakar</option>
        <option value="Paris">Paris</option>
        <option value="Ziguinchor">Ziguinchor</option>
        <option value="Bamako">Bamako</option>
        <option value="Casablanca">Casablanca</option>
    </select>
</div>

{{-- Champ Classe --}}
<div class="mb-3">
    <label class="form-label fw-semibold" style="color:#1a365d;">Classe de Voyage</label>
    <select name="classe" class="form-select" style="border-radius:8px;" required>
        <option value="" selected disabled>Choisir la classe...</option>
        <option value="Économique">Économique</option>
        <option value="Business">Business</option>
        <option value="Première">Première Class</option>
    </select>
</div>

            <button type="submit" class="btn w-100 fw-bold"
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

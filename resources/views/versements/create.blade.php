@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 style="color:#1e3a8a; font-weight:800;">
             Nouveau Versement
        </h3>

        <span class="badge px-3 py-2 fs-6"
              style="background:#f97316; color:white; border-radius:12px;">
            EMS Voyage : Banque
        </span>

    </div>

    <!-- CARD -->
    <div class="card shadow-sm border-0 p-4"
         style="border-radius:16px; background:#ffffff;">

        <form action="{{ route('versements.store') }}" method="POST">
            @csrf

            <!-- BORDEREAU -->
            <div class="mb-3">
                <label style="font-weight:600; color:#1e3a8a;">
                     Bordereau
                </label>

                <select name="bordereau_id"
                        class="form-control"
                        style="border-radius:10px; border:1px solid #d1d5db;"
                        required>

                    <option value="">-- Choisir un bordereau --</option>

                    @foreach($bordereaux as $b)
                        <option value="{{ $b->id }}">
                            {{ $b->numero_bordereau }}
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- MONTANT -->
            <div class="mb-3">
                <label style="font-weight:600; color:#1e3a8a;">
                     Montant (FCFA)
                </label>

                <input type="number"
                       name="montant"
                       class="form-control"
                       placeholder="Ex: 150000"
                       style="border-radius:10px; border:1px solid #d1d5db;"
                       required>
            </div>

            <!-- BANQUE -->
            <div class="mb-3">
                <label style="font-weight:600; color:#1e3a8a;">
                     Banque
                </label>

                <input type="text"
                       name="banque"
                       class="form-control"
                       placeholder="Ex: CBAO, Ecobank..."
                       style="border-radius:10px; border:1px solid #d1d5db;"
                       required>
            </div>

            <!-- DATE -->
            <div class="mb-3">
                <label style="font-weight:600; color:#1e3a8a;">
                     Date de versement
                </label>

                <input type="date"
                       name="date_versement"
                       class="form-control"
                       style="border-radius:10px; border:1px solid #d1d5db;"
                       required>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="btn w-100 fw-bold"
                    style="background:linear-gradient(135deg,#1e3a8a,#2563eb);
                           color:white;
                           padding:12px;
                           border-radius:12px;">
                 Ajouter le versement
            </button>

        </form>

    </div>

</div>

@endsection

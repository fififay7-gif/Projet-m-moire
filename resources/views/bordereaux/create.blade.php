@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card shadow border-0">

        <div class="card-header text-white"
             style="background: linear-gradient(135deg,#0f2a6b,#2563eb);">
            <h3 class="mb-0">
                 Nouveau Bordereau
            </h3>
        </div>

        <div class="card-body p-4">

            <form action="{{ route('bordereaux.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="form-label fw-bold">
                        Montant total (FCFA)
                    </label>

                    <input type="number"
                           step="0.01"
                           name="montant_total"
                           class="form-control form-control-lg"
                           placeholder="Entrer le montant total"
                           required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">
                        Date du bordereau
                    </label>

                    <input type="date"
                           name="date_bordereau"
                           class="form-control form-control-lg"
                           required>
                </div>

                <div class="d-flex justify-content-end">

                    <a href="{{ route('bordereaux.index') }}"
                       class="btn btn-secondary me-2">
                        Annuler
                    </a>

                    <button type="submit"
                            class="btn text-white"
                            style="background:#f97316;">
                         Enregistrer
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection

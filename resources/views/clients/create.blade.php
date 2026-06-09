@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card shadow border-0">

        <div class="card-header text-white"
             style="background:linear-gradient(135deg,#0f2a6b,#2563eb);">

            <h3 class="mb-0">
                 Ajouter un Client
            </h3>

        </div>

        <div class="card-body p-4">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="/clients/store">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            Nom
                        </label>

                        <input type="text"
                               name="nom"
                               class="form-control"
                               placeholder="Entrer le nom"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            Prénom
                        </label>

                        <input type="text"
                               name="prenom"
                               class="form-control"
                               placeholder="Entrer le prénom"
                               required>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            Téléphone
                        </label>

                        <input type="text"
                               name="telephone"
                               class="form-control"
                               placeholder="77 000 00 00">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            Email
                        </label>

                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="exemple@email.com">
                    </div>

                </div>

                <div class="mb-4">

                    <label class="form-label fw-bold">
                        Adresse
                    </label>

                    <input type="text"
                           name="adresse"
                           class="form-control"
                           placeholder="Entrer l'adresse du client">

                </div>

                <div class="d-flex justify-content-end">

                    <a href="/clients"
                       class="btn btn-secondary me-2">
                        Retour
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

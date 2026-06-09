@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 style="color:#0f2a6b;font-weight:bold;">
            Gestion des Clients
        </h2>

        <a href="/clients/create"
           class="btn text-white"
           style="background:#f97316;border:none;">
             Ajouter un Client
        </a>

    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow border-0">

        <div class="card-header text-white"
             style="background:linear-gradient(135deg,#0f2a6b,#2563eb);">

            <h5 class="mb-0">
                Liste des Clients
            </h5>

        </div>

        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">

                <thead style="background:#eaf1ff;">

                    <tr>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Adresse</th>
                        <th width="120">Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($clients as $client)

                    <tr>

                        <td class="fw-bold">
                            {{ $client->nom }}
                        </td>

                        <td>
                            {{ $client->telephone }}
                        </td>

                        <td>
                            {{ $client->email }}
                        </td>

                        <td>
                            {{ $client->adresse }}
                        </td>

                        <td>

                            <form method="POST"
                                  action="/clients/{{ $client->id }}"
                                  onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                     Supprimer
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5"
                            class="text-center py-4 text-muted">

                            Aucun client enregistré.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection

@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 style="color: #1e3a8a; font-weight: 800;">
            Gestion des Réservations
        </h3>

        <a href="/reservations/create"
           class="btn fw-bold px-4 py-2"
           style="background: linear-gradient(135deg, #1e3a8a, #2563eb);
                  color: white;
                  border-radius: 12px;">
             Nouvelle réservation
        </a>

    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success shadow-sm border-0"
             style="border-radius: 12px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLE CARD -->
    <div class="card shadow-sm border-0"
         style="border-radius: 16px; overflow: hidden;">

        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">

                <!-- HEADER TABLE -->
                <thead style="background: #1e3a8a; color: white;">
                    <tr>
                        <th>Client</th>
                        <th>Service</th>
                        <th>Description</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($reservations as $r)
                        <tr>

                            <td style="font-weight:600; color:#1e3a8a;">
                                {{ $r->client->nom }}
                            </td>

                            <td>
                                {{ $r->type_service }}
                            </td>

                            <td style="max-width: 250px;">
                                {{ $r->description }}
                            </td>

                            <!-- STATUT -->
                            <td>

                                @switch($r->statut)

                                    @case('en_attente')
                                        <span class="badge px-3 py-2"
                                              style="background:#f59e0b;">
                                             En attente
                                        </span>
                                        @break

                                    @case('validee')
                                        <span class="badge px-3 py-2"
                                              style="background:#10b981;">
                                            ✔ Validée
                                        </span>
                                        @break

                                    @case('rejetee')
                                        <span class="badge px-3 py-2"
                                              style="background:#ef4444;">
                                            ✖ Rejetée
                                        </span>
                                        @break

                                    @default
                                        <span class="badge px-3 py-2"
                                              style="background:#6366f1;">
                                             Terminée
                                        </span>

                                @endswitch

                            </td>

                            <td>
                                {{ $r->date_reservation }}
                            </td>

                            <!-- ACTIONS -->
                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-2">

                                    <a href="/reservations/{{ $r->id }}/validee"
                                       class="btn btn-sm fw-bold"
                                       style="background:#10b981; color:white; border-radius:8px;">

                                    </a>

                                    <a href="/reservations/{{ $r->id }}/rejetee"
                                       class="btn btn-sm fw-bold"
                                       style="background:#ef4444; color:white; border-radius:8px;">

                                    </a>

                                    <form action="/reservations/{{ $r->id }}"
                                          method="POST"
                                          onsubmit="return confirm('Supprimer cette réservation ?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm fw-bold"
                                                style="background:#1f2937; color:white; border-radius:8px;">

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection

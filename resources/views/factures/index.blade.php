@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 style="color: #1e3a8a; font-weight: 800;">
             Gestion des Factures
        </h3>

        <a href="/factures/create"
           class="btn fw-bold px-4 py-2"
           style="background: linear-gradient(135deg, #1e3a8a, #2563eb);
                  color: white;
                  border-radius: 12px;">
             Nouvelle facture
        </a>
    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLE CARD -->
    <div class="card shadow-sm border-0"
         style="border-radius: 16px; overflow: hidden;">

        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">

                <thead style="background: #1e3a8a; color: white;">
                    <tr>
                        <th>N° Facture</th>
                        <th>Client</th>
                        <th>Montant</th>
                        <th>Payé</th>
                        <th>Reste</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($factures as $f)
                        <tr>

                            <td style="font-weight:600; color:#1e3a8a;">
                                {{ $f->numero_facture }}
                            </td>

                            <td>
                                {{ $f->client->nom }}
                            </td>

                            <td>
                                {{ number_format($f->montant, 0, ',', ' ') }} FCFA
                            </td>

                            <td style="color:#10b981; font-weight:600;">
                                {{ number_format($f->montant_paye, 0, ',', ' ') }} FCFA
                            </td>

                            <td style="color:#ef4444; font-weight:600;">
                                {{ number_format($f->reste_a_payer, 0, ',', ' ') }} FCFA
                            </td>

                            <td>
                                @if($f->statut == 'impayee')
                                    <span class="badge px-3 py-2" style="background:#ef4444;">
                                        Impayée
                                    </span>
                                @elseif($f->statut == 'partielle')
                                    <span class="badge px-3 py-2" style="background:#f97316;">
                                        Partielle
                                    </span>
                                @else
                                    <span class="badge px-3 py-2" style="background:#10b981;">
                                        Payée
                                    </span>
                                @endif
                            </td>

                            <td>
                                {{ $f->date_facture }}
                            </td>

                            <td class="d-flex gap-2">

                                <a href="/factures/{{ $f->id }}"
                                   class="btn btn-sm fw-bold"
                                   style="background:#2563eb; color:white; border-radius:8px;">
                                     Voir
                                </a>

                                <a href="/factures/{{ $f->id }}/pdf"
                                   class="btn btn-sm fw-bold"
                                   style="background:#dc2626; color:white; border-radius:8px;">
                                     PDF
                                </a>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection

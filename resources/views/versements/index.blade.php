@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 style="color:#1e3a8a; font-weight:800;">
                 Registre des Versements
            </h2>
            <p style="color:#6b7280; margin:0;">
                Suivi des dépôts bancaires et des reçus de caisse
            </p>
        </div>

        <button class="btn fw-bold px-4 py-2"
                data-bs-toggle="modal"
                data-bs-target="#modalVersement"
                style="background: linear-gradient(135deg, #10b981, #059669);
                       color: white;
                       border-radius: 12px;">
             Ajouter un versement
        </button>

    </div>

    <!-- TABLE CARD -->
    <div class="card shadow-sm border-0"
         style="border-radius:16px; overflow:hidden;">

        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">

                <!-- HEADER TABLE -->
                <thead style="background:#1e3a8a; color:white;">
                    <tr>
                        <th>Référence</th>
                        <th>Montant</th>
                        <th>Banque</th>
                        <th>Date</th>
                        <th>Saisi par</th>
                        <th>Bordereau</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($versements as $versement)

                        <tr>

                            <td style="font-weight:700; color:#10b981;">
                                {{ $versement->reference_versement }}
                            </td>

                            <td style="font-weight:700; color:#1e3a8a;">
                                {{ number_format($versement->montant, 0, ',', ' ') }} FCFA
                            </td>

                            <td>
                                <span class="badge px-3 py-2"
                                      style="background:#f97316; color:white;">
                                     {{ $versement->banque }}
                                </span>
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($versement->date_versement)->format('d/m/Y') }}
                            </td>

                            <td>
                                {{ $versement->user->name }}
                            </td>

                            <td>

                                @if($versement->bordereau)

                                    <span class="badge px-3 py-2"
                                          style="background:#6366f1; color:white;">
                                         {{ $versement->bordereau->code_bordereau }}
                                    </span>

                                @else

                                    <span class="badge px-3 py-2"
                                          style="background:#6b7280; color:white;">
                                        Aucun
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Aucun versement enregistré
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- ================= MODAL EMS ================= -->
<div class="modal fade" id="modalVersement" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <form action="{{ route('versements.store') }}"
              method="POST"
              class="modal-content border-0"
              style="border-radius:16px; overflow:hidden;">

            @csrf

            <!-- HEADER MODAL -->
            <div class="modal-header text-white"
                 style="background: linear-gradient(135deg, #1e3a8a, #2563eb);">

                <h5 class="modal-title fw-bold">
                     Nouveau Versement
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <!-- REF -->
                <div class="mb-3">
                    <label style="font-weight:600; color:#1e3a8a;">
                        Référence du versement
                    </label>

                    <input type="text"
                           name="reference_versement"
                           class="form-control"
                           placeholder="Ex: VR-CBAO-12345"
                           style="border-radius:10px;"
                           required>
                </div>

                <!-- MONTANT + BANQUE -->
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label style="font-weight:600; color:#1e3a8a;">
                            Montant (FCFA)
                        </label>

                        <input type="number"
                               name="montant"
                               class="form-control"
                               placeholder="Ex: 500000"
                               style="border-radius:10px;"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label style="font-weight:600; color:#1e3a8a;">
                            Banque
                        </label>

                        <select name="banque"
                                class="form-control"
                                style="border-radius:10px;"
                                required>

                            <option value="">-- Choisir --</option>
                            <option>CBAO</option>
                            <option>SGBS</option>
                            <option>Ecobank</option>
                            <option>BNDE</option>
                            <option>Orabank</option>

                        </select>

                    </div>

                </div>

                <!-- DATE + BORDEREAU -->
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label style="font-weight:600; color:#1e3a8a;">
                            Date de dépôt
                        </label>

                        <input type="date"
                               name="date_versement"
                               class="form-control"
                               style="border-radius:10px;"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label style="font-weight:600; color:#1e3a8a;">
                            Bordereau
                        </label>

                        <select name="bordereau_id"
                                class="form-control"
                                style="border-radius:10px;">

                            <option value="">Aucun</option>

                            @foreach($bordereauxLibres as $bordereau)
                                <option value="{{ $bordereau->id }}">
                                    {{ $bordereau->code_bordereau }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Annuler
                </button>

                <button type="submit"
                        class="btn fw-bold"
                        style="background: linear-gradient(135deg, #10b981, #059669);
                               color:white;">
                    Enregistrer
                </button>

            </div>

        </form>

    </div>

</div>

@endsection

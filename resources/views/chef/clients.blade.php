@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4" style="background-color: #f8f9fa; min-height: 100vh;">

    {{-- En-tête de la page --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2" style="border-bottom: 2px solid #e9ecef;">
        <h4 class="fw-bold mb-0" style="color: #1e3a8a;">
            <i class="ti ti-users me-2" style="color: #ff6b00;"></i>Liste des Clients
        </h4>
        <span class="badge px-3 py-2 text-white" style="background-color: #ff6b00; font-size: 13px; border-radius: 20px;">
            Espace Consultation (Lecture Seule)
        </span>
    </div>

    {{-- Tableau des Clients --}}
    <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
        <div class="card-header py-3 text-white d-flex justify-content-between align-items-center" style="background-color: #1a365d;">
            <h6 class="mb-0 fw-semibold text-white">
                <i class="ti ti-list me-2"></i>Répertoire des clients enregistrés
            </h6>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 14px; table-layout: fixed; width: 100%;">
                    <thead class="table-light text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="ps-4 py-3 text-secondary" style="width: 15%;">ID Client</th>
                            <th class="text-secondary" style="width: 25%;">Prénom</th>
                            <th class="text-secondary" style="width: 25%;">Nom</th>
                            <th class="text-secondary" style="width: 35%;">Adresse Email / Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $client)
                        <tr style="transition: all 0.2s ease;">

                            {{-- 1. ID CLIENT --}}
                            <td class="ps-4 fw-bold text-dark">
                                #{{ $client->id }}
                            </td>

                            {{-- 2. PRÉNOM --}}
                            <td class="fw-semibold text-secondary">
                                {{ $client->prenom ?? $client->first_name ?? '---' }}
                            </td>

                            {{-- 3. NOM --}}
                            <td class="fw-semibold text-secondary text-uppercase">
                                {{ $client->nom ?? $client->last_name ?? '---' }}
                            </td>

                            {{-- 4. CONTACT / EMAIL --}}
                            <td class="text-muted">
                                @if($client->email)
                                    <i class="ti ti-mail me-1" style="font-size: 13px;"></i> {{ $client->email }}
                                @elseif($client->telephone ?? $client->phone)
                                    <i class="ti ti-phone me-1" style="font-size: 13px;"></i> {{ $client->telephone ?? $client->phone }}
                                @else
                                    <span class="text-muted fw-normal">Aucun contact enregistré</span>
                                @endif
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">
                                <i class="ti ti-users-minus d-block fs-2 mb-2 text-secondary"></i>
                                Aucun client trouvé dans la base de données.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

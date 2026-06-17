@extends('layouts.app')

@section('content')

<style>

body{
    background:#f5f7fb;
}

/* TITLE */
.page-title{
    color:#1e3a8a;
    margin-bottom:25px;
    font-size:28px;
    font-weight:bold;
}

/* ADD BUTTON */
.btn-add{
    background:linear-gradient(135deg,#1e3a8a,#2563eb);
    color:white;
    padding:12px 18px;
    border:none;
    border-radius:10px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
    margin-bottom:20px;
}

.btn-add:hover{
    transform:translateY(-2px);
}

/* DELETE */
.btn-delete{
    background:linear-gradient(135deg,#f97316,#ea580c);
    color:white;
    padding:10px 12px;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

.btn-delete:hover{
    transform:scale(1.05);
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,0.06);
}

table th{
    background:linear-gradient(135deg,#1e3a8a,#2563eb);
    color:white;
    padding:15px;
}

table td{
    padding:15px;
    text-align:center;
    border-bottom:1px solid #eee;
}

/* ROLES - EMS VOYAGE STYLE */
.role{
    padding:5px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
    display: inline-block;
}

/* Style pour Chef d'agence */
.role.chef_agence{
    background:#e0ecff;
    color:#1e3a8a;
}

/* Style pour Comptable */
.role.comptable{
    background:#e6f4ea;
    color:#137333;
}

/* Style pour Agent de comptoir */
.role.agent_comptoir{
    background:#fff1e6;
    color:#f97316;
}

/* Au cas où l'ancien administrateur traîne encore */
.role.administrateur{
    background:#f3e8ff;
    color:#6b21a8;
}

/* MODAL HEADER */
.modal-header{
    background:linear-gradient(135deg,#1e3a8a,#2563eb);
    color:white;
}

.form-control{
    border-radius:10px;
    padding:10px;
}

</style>

<h1 class="page-title">Gestion des utilisateurs</h1>

<button class="btn-add" data-bs-toggle="modal" data-bs-target="#addUserModal">
    Ajouter utilisateur
</button>

<table>
    <thead>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Adresse</th>
            <th>Profil (Rôle)</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->telephone ?? 'N/A' }}</td>
            <td>{{ $user->adresse ?? 'N/A' }}</td>
            <td>
                <span class="role {{ $user->profil }}">
                    @if($user->profil == 'chef_agence') Chef d'agence
                    @elseif($user->profil == 'comptable') Comptable
                    @elseif($user->profil == 'agent_comptoir') Agent de comptoir
                    @else {{ $user->profil }}
                    @endif
                </span>
            </td>
            <td>
                <div style="display: flex; gap: 8px; align-items: center;">

                    <form action="/users/{{ $user->id }}/toggle-status" method="POST" class="form-toggle-status" data-name="{{ $user->first_name }} {{ $user->last_name }}" data-status="{{ $user->statut }}">
                        @csrf
                        @if($user->statut == 'actif')
                            <button type="button" class="btn-toggle" style="background: #c5221f; color: white; border: none; padding: 6px 12px; border-radius: 8px; font-weight: bold; font-size: 13px;">
                                Désactiver
                            </button>
                        @else
                            <button type="button" class="btn-toggle" style="background: #137333; color: white; border: none; padding: 6px 12px; border-radius: 8px; font-weight: bold; font-size: 13px;">
                                Activer
                            </button>
                        @endif
                    </form>

                    <button type="button" style="background: #2563eb; color: white; border: none; padding: 6px 12px; border-radius: 8px; font-weight: bold; font-size: 13px;" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                        Modifier
                    </button>

                    <form action="/users/{{ $user->id }}" method="POST" style="margin: 0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: #ff6a00; color: white; border: none; padding: 6px 12px; border-radius: 8px; font-weight: bold; font-size: 13px;" onclick="return confirm('Supprimer définitivement cet utilisateur ?')">
                            Supprimer
                        </button>
                    </form>

                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter utilisateur</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="/users/store">
                @csrf
                <div class="modal-body">
                    <input class="form-control mb-2" name="first_name" placeholder="Prénom" required>
                    <input class="form-control mb-2" name="last_name" placeholder="Nom" required>

                    <input class="form-control mb-2" type="email" name="email" placeholder="Email" required>
                    <input class="form-control mb-2" type="password" name="password" placeholder="Mot de passe" required>

                    <input class="form-control mb-2" type="tel" name="telephone" placeholder="Numéro de téléphone">
                    <input class="form-control mb-2" type="text" name="adresse" placeholder="Adresse">

                    <select class="form-control mb-2" name="profil" required>
                        <option value="">-- Sélectionner un profil --</option>
                        <option value="chef_agence">Chef d'agence</option>
                        <option value="agent_comptoir">Agent de comptoir</option>
                        <option value="comptable">Comptable</option>
                    </select>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-add" style="margin-bottom: 0;">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger" style="color: red; background: #ffe6e6; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="modal fade" id="addUserModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Ajouter utilisateur</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="/users/store">

                @csrf

                <div class="modal-body">

                    <input class="form-control mb-2" name="name" placeholder="Nom" required>
                    <input class="form-control mb-2" type="email" name="email" placeholder="Email" required>
                    <input class="form-control mb-2" type="password" name="password" placeholder="Mot de passe" required>

                    <select class="form-control mb-2" name="role" required>
                        <option value="">-- Sélectionner un poste --</option>
                        <option value="chef_agence">Chef d'agence</option>
                        <option value="agent_comptoir">Agent de comptoir</option>
                        <option value="comptable">Comptable</option>
                    </select>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn-add" style="margin-bottom: 0;">
                        Ajouter
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.btn-toggle');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('.form-toggle-status');
            const userName = form.getAttribute('data-name');
            const currentStatus = form.getAttribute('data-status');

            const isActivating = currentStatus !== 'actif';
            const titleText = isActivating ? 'Activer le compte ?' : 'Désactiver le compte ?';
            const confirmButtonText = isActivating ? 'Oui, activer' : 'Oui, désactiver';
            const confirmButtonColor = isActivating ? '#137333' : '#c5221f';
            const iconType = isActivating ? 'question' : 'warning';

            // Boîte de dialogue plus petite et compacte
            Swal.fire({
                title: titleText,
                text: `Changer le statut de ${userName} ?`,
                icon: iconType,
                width: '380px', // Taille réduite ici
                showCancelButton: true,
                confirmButtonColor: confirmButtonColor,
                cancelButtonColor: '#64748b',
                confirmButtonText: confirmButtonText,
                cancelButtonText: 'Annuler',
                background: '#ffffff',
                padding: '1.25rem', // Marges internes réduites
                customClass: {
                    popup: 'shadow-sm',
                    title: 'fs-5 fw-bold', // Titre plus petit
                    htmlContainer: 'fs-6 text-muted' // Texte plus discret
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>


@foreach($users as $user)
<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header" style="background: #2563eb; color: white; border-top-left-radius: 19px; border-top-right-radius: 19px;">
                <h5 class="modal-title">Modifier l'utilisateur</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="/users/{{ $user->id }}/update">
                @csrf
                @method('PUT')
                <div class="modal-body" style="padding: 20px;">
                    <div class="row">
                        <div class="col-6 mb-2">
                            <label class="small fw-bold text-muted">Prénom</label>
                            <input class="form-control" name="first_name" value="{{ $user->first_name }}" required>
                        </div>
                        <div class="col-6 mb-2">
                            <label class="small fw-bold text-muted">Nom</label>
                            <input class="form-control" name="last_name" value="{{ $user->last_name }}" required>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="small fw-bold text-muted">Email</label>
                        <input class="form-control" type="email" name="email" value="{{ $user->email }}" required>
                    </div>

                    <div class="mb-2">
                        <label class="small fw-bold text-muted">Téléphone</label>
                        <input class="form-control" type="tel" name="telephone" value="{{ $user->telephone }}">
                    </div>

                    <div class="mb-2">
                        <label class="small fw-bold text-muted">Adresse</label>
                        <input class="form-control" type="text" name="adresse" value="{{ $user->adresse }}">
                    </div>

                    <div class="mb-2">
                        <label class="small fw-bold text-muted">Profil (Rôle)</label>
                        <select class="form-control" name="profil" required>
                            <option value="chef_agence" {{ $user->profil == 'chef_agence' ? 'selected' : '' }}>Chef d'agence</option>
                            <option value="agent_comptoir" {{ $user->profil == 'agent_comptoir' ? 'selected' : '' }}>Agent de comptoir</option>
                            <option value="comptable" {{ $user->profil == 'comptable' ? 'selected' : '' }}>Comptable</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: none;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">Annuler</button>
                    <button type="submit" class="btn-add" style="background: #2563eb; border-color: #2563eb; margin-bottom: 0;">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

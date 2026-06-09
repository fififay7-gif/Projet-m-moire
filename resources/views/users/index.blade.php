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

            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @foreach($users as $user)

        <tr>


            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>

            <td>
                <span class="role {{ $user->role }}">
                    @if($user->role == 'chef_agence') Chef d'agence
                    @elseif($user->role == 'comptable') Comptable
                    @elseif($user->role == 'agent_comptoir') Agent de comptoir
                    @else {{ $user->role }}
                    @endif
                </span>
            </td>

            <td>

                <form action="/users/{{ $user->id }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="btn-delete"
                            onclick="return confirm('Supprimer cet utilisateur ?')">
                        Supprimer
                    </button>



                </form>

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

@endsection

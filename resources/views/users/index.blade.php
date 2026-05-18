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

/* ROLE */
.role{
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

.role.admin{
    background:#fff1e6;
    color:#f97316;
}

.role.user{
    background:#e0ecff;
    color:#1e3a8a;
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

<!-- BUTTON ADD -->
<button class="btn-add" data-bs-toggle="modal" data-bs-target="#addUserModal">
    + Ajouter utilisateur
</button>

<!-- TABLE -->
<table>

    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @foreach($users as $user)

        <tr>

            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>

            <td>
                <span class="role {{ $user->role }}">
                    {{ $user->role }}
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

<!-- MODAL AJOUT UTILISATEUR -->
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

                    <input class="form-control mb-2" name="name" placeholder="Nom">
                    <input class="form-control mb-2" name="email" placeholder="Email">
                    <input class="form-control mb-2" type="password" name="password" placeholder="Mot de passe">

                    <select class="form-control mb-2" name="role">
                        <option value="admin">Admin</option>
                        <option value="user">Utilisateur</option>
                    </select>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn-add">
                        Ajouter
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection

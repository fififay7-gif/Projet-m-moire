@extends('layouts.app')

@section('content')

<style>

    .page-title{
        color:#1e3a8a;
        margin-bottom:25px;
    }

    .top-buttons{
        display:flex;
        gap:15px;
        margin-bottom:25px;
    }

    .btn{
        padding:12px 18px;
        border:none;
        border-radius:8px;
        color:white;
        text-decoration:none;
        cursor:pointer;
        font-weight:bold;
    }

    .btn-add{
        background:#2563eb;
    }

    .btn-add:hover{
        background:#1e3a8a;
    }

    .btn-delete{
        background:#dc2626;
    }

    .btn-delete:hover{
        background:#991b1b;
    }

    table{
        width:100%;
        border-collapse:collapse;
        background:white;
        border-radius:15px;
        overflow:hidden;
        box-shadow:0 5px 15px rgba(0,0,0,0.08);
    }

    table th{
        background:#1e3a8a;
        color:white;
        padding:15px;
    }

    table td{
        padding:15px;
        border-bottom:1px solid #ddd;
        text-align:center;
    }

</style>

<h1 class="page-title">
     Gestion des utilisateurs
</h1>

<!--  BOUTONS -->
<div class="top-buttons">

    <a href="/register" class="btn btn-add">
         Ajouter utilisateur
    </a>

</div>

<!--  TABLE -->
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

            <td>{{ $user->role }}</td>

            <td>

                <form action="/users/{{ $user->id }}"
                      method="POST">

                    @csrf
                    @method('DELETE')

                   <button type="submit"
        class="btn btn-delete"

        onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')">

     Supprimer

</button>
                </form>

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

@endsection

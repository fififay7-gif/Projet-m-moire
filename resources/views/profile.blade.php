@extends('layouts.app')

@section('content')

<style>

    .profile-container{
        max-width:700px;
        margin:auto;
    }

    .profile-card{
        background:white;
        padding:30px;
        border-radius:20px;
        box-shadow:0 5px 15px rgba(0,0,0,0.08);
    }

    .profile-header{
        text-align:center;
        margin-bottom:30px;
    }

    .profile-avatar{
        width:100px;
        height:100px;
        border-radius:50%;
        background:#2563eb;
        color:white;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:40px;
        margin:auto;
        margin-bottom:15px;
    }

    .profile-header h2{
        color:#1e3a8a;
        margin-bottom:5px;
    }

    .profile-header p{
        color:gray;
    }

    .info-group{
        margin-bottom:20px;
    }

    .info-label{
        font-weight:bold;
        color:#1e3a8a;
        margin-bottom:8px;
    }

    .info-value{
        background:#f0f4ff;
        padding:12px;
        border-radius:10px;
        color:#333;
    }

</style>

<div class="profile-container">

    <div class="profile-card">

        <!-- PHOTO -->
        <div class="profile-header">

            <div class="profile-avatar">

                {{ strtoupper(substr($user->name,0,1)) }}

            </div>

            <h2>
                {{ $user->name }}
            </h2>

            <p>
                {{ $user->role }}
            </p>

        </div>

        <!-- NOM -->
        <div class="info-group">

            <div class="info-label">
                Nom complet
            </div>

            <div class="info-value">
                {{ $user->name }}
            </div>

        </div>

        <!-- EMAIL -->
        <div class="info-group">

            <div class="info-label">
                Adresse email
            </div>

            <div class="info-value">
                {{ $user->email }}
            </div>

        </div>

        <!-- ROLE -->
        <div class="info-group">

            <div class="info-label">
                Rôle
            </div>

            <div class="info-value">
                {{ $user->role }}
            </div>

        </div>

        <!-- DATE -->
        <div class="info-group">

            <div class="info-label">
                Date d'inscription
            </div>

            <div class="info-value">
                {{ $user->created_at->format('d/m/Y') }}
            </div>

        </div>

    </div>

</div>

@endsection

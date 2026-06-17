@extends('layouts.app')

@section('content')

<style>

body{
    background:#f5f7fb;
}

/* CONTAINER */
.profile-container{
    max-width:550px;
    margin:auto;
    margin-top:30px;
}

/* CARD */
.profile-card{
    background:white;
    padding:35px;
    border-radius:25px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    border-top:5px solid #ff6a00;
}

/* AVATAR */
.avatar{
    width:80px;
    height:80px;
    background:linear-gradient(135deg,#2563eb,#1e3a8a);
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
    margin:auto;
    margin-bottom:20px;
    font-size:26px;
    color:white;
    font-weight:bold;
    box-shadow:0 8px 20px rgba(37,99,235,0.25);
}

/* TITLE */
.profile-card h2{
    text-align:center;
    color:#1e3a8a;
    margin-bottom:5px;
    font-size:26px;
}

/* SUB TITLE */
.subtitle{
    text-align:center;
    color:#64748b;
    margin-bottom:20px;
    font-size:14px;
}

/* INFO BLOCK */
.info-box{
    margin-bottom:18px;
}

.label{
    display:block;
    margin-bottom:8px;
    color:#1e3a8a;
    font-weight:bold;
}

.value{
    width:100%;
    padding:14px;
    border:1px solid #dbeafe;
    border-radius:12px;
    background:#f8fbff;
    font-size:14px;
    color:#333;
}

/* BUTTON (Style lien propre) */
.btn-action{
    display: block;
    text-align: center;
    text-decoration: none;
    background:linear-gradient(135deg,#ff6a00,#e65c00);
    color:white;
    border:none;
    padding:15px;
    border-radius:12px;
    font-size:15px;
    font-weight:bold;
    transition:0.3s;
    box-shadow:0 6px 18px rgba(255,106,0,0.25);
    margin-top:20px;
}

.btn-action:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 25px rgba(255,106,0,0.35);
    color: white;
}

/* ROLE BADGE */
.role-badge{
    text-align:center;
    margin-bottom:20px;
}

.role-text {
    background: #fff1e6;
    color: #ff6a00;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: bold;
    display: inline-block;
}

</style>

<div class="profile-container">

    <div class="profile-card">

        <div class="avatar">
            {{ strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1)) }}
        </div>

        <h2>Mon Profil</h2>

        <p class="subtitle">
            Informations personnelles du compte
        </p>

        <div class="role-badge">
            <span class="role-text">
                @if($user->profil == 'chef_agence') CHEF D'AGENCE
                @elseif($user->profil == 'comptable') COMPTABLE
                @elseif($user->profil == 'agent_comptoir') AGENT DE COMPTOIR
                @else {{ strtoupper($user->profil) }}
                @endif
            </span>
        </div>

        <div class="info-box">
            <div class="label">Prénom</div>
            <div class="value">{{ $user->first_name }}</div>
        </div>

        <div class="info-box">
            <div class="label">Nom</div>
            <div class="value">{{ $user->last_name }}</div>
        </div>

        <div class="info-box">
            <div class="label">Email</div>
            <div class="value">{{ $user->email }}</div>
        </div>

        <div class="info-box">
            <div class="label">Téléphone</div>
            <div class="value">{{ $user->telephone ?? 'Non renseigné' }}</div>
        </div>

        <div class="info-box">
            <div class="label">Adresse</div>
            <div class="value">{{ $user->adresse ?? 'Non renseignée' }}</div>
        </div>

        <div class="info-box">
            <div class="label">Statut du compte</div>
           <div class="fw-bold {{ $user->statut == 'actif' ? 'text-success' : 'text-danger' }}">
    {{ ucfirst($user->statut) }}
</div>
        </div>





    </div>

</div>

@endsection

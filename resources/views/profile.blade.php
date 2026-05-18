@extends('layouts.app')

@section('content')

<style>

body{
    background:#f5f7fb;
}

/* CONTAINER (même que password) */
.profile-container{
    max-width:550px;
    margin:auto;
    margin-top:30px;
}

/* CARD (même style) */
.profile-card{
    background:white;
    padding:35px;
    border-radius:25px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    border-top:5px solid #ff6a00;
}

/* AVATAR (même logique icône) */
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
    font-size:30px;
    color:white;
    font-weight:bold;
    box-shadow:0 8px 20px rgba(37,99,235,0.25);
}

/* TITLE */
.profile-card h2{
    text-align:center;
    color:#1e3a8a;
    margin-bottom:25px;
    font-size:26px;
}

/* SUB TITLE */
.subtitle{
    text-align:center;
    color:#64748b;
    margin-bottom:25px;
    font-size:14px;
}

/* INFO BLOCK (style input-like pour homogénéité) */
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

/* BUTTON (même orange que password) */
.btn{
    width:100%;
    background:linear-gradient(135deg,#ff6a00,#e65c00);
    color:white;
    border:none;
    padding:15px;
    border-radius:12px;
    cursor:pointer;
    font-size:15px;
    font-weight:bold;
    transition:0.3s;
    box-shadow:0 6px 18px rgba(255,106,0,0.25);
    margin-top:10px;
}

.btn:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 25px rgba(255,106,0,0.35);
}

/* ROLE BADGE */
.role{
    text-align:center;
    margin-bottom:15px;
    color:#ff6a00;
    font-weight:bold;
}

</style>

<div class="profile-container">

    <div class="profile-card">

        <!-- AVATAR -->
        <div class="avatar">
            {{ strtoupper(substr($user->name,0,1)) }}
        </div>

        <!-- TITLE -->
        <h2>Mon Profil</h2>

        <p class="subtitle">
            Informations personnelles du compte EMS
        </p>

        <!-- ROLE -->
        <div class="role">
            {{ strtoupper($user->role) }}
        </div>

        <!-- NAME -->
        <div class="info-box">
            <div class="label">Nom complet</div>
            <div class="value">{{ $user->name }}</div>
        </div>

        <!-- EMAIL -->
        <div class="info-box">
            <div class="label">Email</div>
            <div class="value">{{ $user->email }}</div>
        </div>

        <!-- DATE -->
        <div class="info-box">
            <div class="label">Date inscription</div>
            <div class="value">
                {{ $user->created_at->format('d/m/Y') }}
            </div>
        </div>

        <!-- BUTTON -->
        <a href="/modifier-mot-de-passe" class="btn">
            Modifier mot de passe
        </a>

    </div>

</div>

@endsection

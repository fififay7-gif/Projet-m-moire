@extends('layouts.app')

@section('content')

<style>

body{
    background:#f5f7fb;
}

/* CONTAINER */
.password-container{
    max-width:550px;
    margin:auto;
    margin-top:30px;
}

/* CARD */
.password-card{
    background:white;
    padding:35px;
    border-radius:25px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    border-top:5px solid #ff6a00;
}

/* ICON */
.lock-icon{
    width:80px;
    height:80px;
    background:linear-gradient(135deg,#2563eb,#1e3a8a);
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
    margin:auto;
    margin-bottom:20px;
    font-size:35px;
    color:white;
    box-shadow:0 8px 20px rgba(37,99,235,0.25);
}

/* TITLE */
.password-card h2{
    text-align:center;
    color:#1e3a8a;
    margin-bottom:10px;
    font-size:28px;
}

.subtitle{
    text-align:center;
    color:#64748b;
    margin-bottom:30px;
    font-size:14px;
}

/* INPUT GROUP */
.input-group{
    margin-bottom:22px;
}

.input-group label{
    display:block;
    margin-bottom:8px;
    color:#1e3a8a;
    font-weight:bold;
}

/* INPUT */
.input-group input{
    width:100%;
    padding:14px;
    border:1px solid #dbeafe;
    border-radius:12px;
    outline:none;
    transition:0.3s;
    background:#f8fbff;
    font-size:14px;
}

.input-group input:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 3px rgba(37,99,235,0.1);
}

/* BUTTON */
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
}

.btn:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 25px rgba(255,106,0,0.35);
}

/* SUCCESS */
.success{
    background:#dcfce7;
    color:#166534;
    padding:14px;
    border-radius:10px;
    margin-bottom:20px;
    border-left:5px solid #22c55e;
}

/* ERROR */
.error{
    background:#fee2e2;
    color:#dc2626;
    padding:14px;
    border-radius:10px;
    margin-bottom:20px;
    border-left:5px solid #ef4444;
}

</style>

<div class="password-container">

    <div class="password-card">


        <!-- TITLE -->
        <h2>
            Modifier mot de passe
        </h2>

        <p class="subtitle">
            Sécurisez votre compte EMS avec un nouveau mot de passe.
        </p>

        {{-- SUCCESS --}}
        @if(session('success'))

            <div class="success">
                {{ session('success') }}
            </div>

        @endif

        {{-- ERROR --}}
        @if(session('error'))

            <div class="error">
                {{ session('error') }}
            </div>

        @endif

        <form method="POST" action="/modifier-mot-de-passe">

            @csrf

            <!-- ANCIEN PASSWORD -->
            <div class="input-group">

                <label>
                    Ancien mot de passe
                </label>

                <input type="password"
                       name="ancien_password"
                       placeholder="Entrez ancien mot de passe">

            </div>

            <!-- NEW PASSWORD -->
            <div class="input-group">

                <label>
                    Nouveau mot de passe
                </label>

                <input type="password"
                       name="password"
                       placeholder="Entrez nouveau mot de passe">

            </div>

            <!-- CONFIRM -->
            <div class="input-group">

                <label>
                    Confirmer mot de passe
                </label>

                <input type="password"
                       name="password_confirmation"
                       placeholder="Confirmez mot de passe">

            </div>

            <!-- BUTTON -->
            <button type="submit" class="btn">

                Modifier mot de passe

            </button>

        </form>

    </div>

</div>

@endsection

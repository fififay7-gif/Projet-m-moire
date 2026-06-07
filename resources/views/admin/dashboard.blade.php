@extends('layouts.app')

@section('content')

<style>

body{
    background:#f5f7fb;
}

.title {
    color:#1e3a8a;
    margin-bottom:25px;
    font-weight:bold;
}

.cards {
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}

.card {
    background:white;
    padding:20px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,0.06);
    text-align:center;
    transition:0.3s;
    border-top:4px solid #2563eb;
}

.card:hover{
    transform:translateY(-6px);
}

.card h3{
    color:#1e3a8a;
    margin-bottom:10px;
    font-weight:bold;
}

.card p{
    color:#64748b;
}

.stats{
    font-size:32px;
    font-weight:bold;
    color:#2563eb;
}

.alert{
    color:#f97316;
}

.section{
    margin-top:35px;
}

.section h2{
    color:#1e3a8a;
    margin-bottom:15px;
}

.action-btn {
    display:inline-block;
    margin-top:10px;
    padding:10px 15px;
    background:#f97316;
    color:white;
    border-radius:10px;
    text-decoration:none;
    font-weight:bold;
}

.action-btn:hover{
    background:#ea580c;
}

</style>

<h1 class="title">Dashboard Administrateur EMS</h1>

<!-- STATS -->
<div class="cards">


    <div class="card">
        <p>Utilisateurs</p>
        <div class="stats">{{ $totalUsers }}</div>
    </div>

</div>

<!-- ACTIONS -->
<div class="section">

    <h2>Actions Rapides</h2>

    <div class="cards">

        <div class="card">
            <h3>Utilisateurs</h3>
            <p>Gérer les comptes utilisateurs</p>
            <a href="/users" class="action-btn">Gérer</a>
        </div>

        

    </div>

</div>

@endsection

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS Voyage - Système de Gestion</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', sans-serif;
        }

        html, body {
            height: 100%;
            overflow-x: hidden;
            overflow-y: auto;
        }

        body{
            background:#f4f7ff;
            display:flex;
        }

        /* ===== SIDEBAR EMS VOYAGE ===== */
        .sidebar{
            width:270px;
            height:100vh;
            background:linear-gradient(180deg,#0f2a6b,#1e3a8a,#2563eb);
            color:white;
            padding:25px;
            position:fixed;
            left:0;
            top:0;
            overflow-y:auto;
            z-index:1000;
            box-shadow:5px 0 25px rgba(0,0,0,0.15);
        }

        .logo-box{
            text-align:center;
            margin-bottom:35px;
        }

        .logo-box img{
            width:110px;
            height:110px;
            object-fit:contain;
            background:white;
            padding:10px;
            border-radius:20px;
        }

        .logo-box h2{
            font-size:20px;
            font-weight:bold;
            color:white;
            margin-top: 10px;
        }

        .logo-box p{
            color:#dbeafe;
            font-size:13px;
        }

        .sidebar-heading {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #93c5fd;
            font-weight: bold;
            margin-top: 20px;
            margin-left: 5px;
            margin-bottom: 5px;
        }

        .sidebar a{
            display:flex;
            align-items:center;
            gap:12px;
            color:white;
            text-decoration:none;
            padding:12px 16px;
            margin:6px 0;
            border-radius:14px;
            font-size:15px;
            transition:0.3s;
            background:rgba(255,255,255,0.06);
        }

        .sidebar a:hover{
            background:#f97316;
            transform:translateX(6px);
            color: white;
        }

        /* ===== CONTENT & FIXED HEADER ===== */
        .content{
            margin-left:270px;
            width:calc(100% - 270px);
            padding:30px;
            padding-top:130px;
            min-height: 100vh;
            overflow-y: auto;
            padding-bottom: 80px;
        }

        .header{
            position:fixed;
            top:0;
            left:270px;
            width:calc(100% - 270px);
            background:white;
            padding:18px 30px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 8px 25px rgba(0,0,0,0.08);
            z-index: 999;
        }

        /* ===== PROFILE DROPDOWN EMS ===== */
        .profile-btn{
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 12px;
            font-weight: 600;
            transition: 0.3s;
        }

        .profile-btn:hover{
            transform: scale(1.05);
            background: linear-gradient(135deg, #2563eb, #f97316);
        }

        .dropdown-content{
            position: absolute;
            right: 0;
            top: 60px;
            width: 260px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            overflow: hidden;
            display: none;
            animation: fadeIn 0.2s ease-in-out;
            border-top: 4px solid #2563eb;
        }

        .dropdown-content.show{
            display: block;
        }

        .dropdown-content a{
            display: block;
            padding: 12px 16px;
            text-decoration: none;
            color: #1e3a8a;
            font-weight: 500;
            transition: 0.3s;
        }

        .dropdown-content a:hover{
            background: #f97316;
            color: white;
            padding-left: 20px;
        }

        .dropdown-content form button{
            width: 100%;
            border: none;
            padding: 12px 16px;
            background: #ef4444;
            color: white;
            font-weight: 600;
            text-align: left;
            transition: 0.3s;
        }

        .dropdown-content form button:hover{
            background: #dc2626;
            padding-left: 20px;
        }

        @keyframes fadeIn{
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>

<div class="sidebar">

    <div class="logo-box">
        <img src="{{ asset('images/ems-logo.png') }}" alt="Logo EMS">
        <h2>EMS Voyage</h2>
        <p>Aiguillage Intelligent</p>
    </div>

    <a href="/dashboard"> Dashboard Accueil</a>

    @if(Auth::user()->role === 'administrateur')
        <div class="sidebar-heading" style="color: #ef4444;">Configuration</div>
        <a href="/users">👥 Gérer les utilisateurs</a>
    @endif

    @if(Auth::user()->role === 'chef_agence')
        <div class="sidebar-heading">Supervision</div>
        <a href="/clients"> Base Clients</a>
        <a href="/reservations"> Réservations globales</a>
        <a href="/factures"> Suivi des factures</a>
        <a href="/bordereaux"> Tous les Bordereaux</a>
        <a href="/versements"> Versements Banque</a>
         <a href="/users"> utilisateurs</a>
    @endif

    @if(Auth::user()->role === 'comptable')
        <div class="sidebar-heading">Gestion Financière</div>
        <a href="/factures"> Factures à valider</a>
        <a href="/paiements"> Suivi des Paiements</a>
        <a href="/bordereaux"> Bordereaux d'envoi</a>
        <a href="/versements">Versements Banque</a>
    @endif

    @if(Auth::user()->role === 'agent_comptoir')
        <div class="sidebar-heading">Opérations Guichet</div>
        <a href="/clients"> Gestion Clients</a>
        <a href="/reservations"> Prise de Réservation</a>
        <a href="/factures"> Émettre une Facture</a>
        <a href="/paiements"> Saisir un paiement</a>
    @endif

</div>

<div class="header">

    <h3>EMS Voyage — Espace
        @if(Auth::user()->role === 'administrateur')
            Administration Système
        @elseif(Auth::user()->role === 'chef_agence')
            Direction
        @elseif(Auth::user()->role === 'comptable')
            Comptabilité
        @elseif(Auth::user()->role === 'agent_comptoir')
            Saisie Comptoir
        @endif
    </h3>

    <div style="position:relative">

        <button class="profile-btn" onclick="toggleMenu()">
              {{ Auth::user()->name }}
        </button>

        <div class="dropdown-content" id="profileDropdown">
            <a href="/profile">Mon profil</a>
            <a href="/change-password">Changer mot de passe</a>
            <hr style="margin:0">

            <form method="POST" action="/logout">
                @csrf
                <button type="submit"> Déconnexion</button>
            </form>
        </div>

    </div>

</div>

<div class="content">
    @yield('content')
</div>

<script>
// Menu profil déroulant
function toggleMenu(){
    document.getElementById("profileDropdown").classList.toggle("show");
}

// Fermer le dropdown si on clique à l'extérieur
window.onclick = function(event) {
    if (!event.target.matches('.profile-btn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
</script>

</body>
</html>

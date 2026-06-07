<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS - Gestion Clients</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', sans-serif;
        }

        body{
            background:#f4f7ff;
            display:flex;
        }

        .sidebar{
            width:270px;
            min-height:100vh;
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
        }

        .logo-box p{
            color:#dbeafe;
            font-size:13px;
        }

        .sidebar a{
            display:flex;
            align-items:center;
            gap:12px;
            color:white;
            text-decoration:none;
            padding:14px 16px;
            margin:10px 0;
            border-radius:14px;
            font-size:15px;
            transition:0.3s;
            background:rgba(255,255,255,0.06);
        }

        .sidebar a:hover{
            background:#f97316;
            transform:translateX(6px);
        }

        .content{
            margin-left:270px;
            width:calc(100% - 270px);
            padding:30px;
            padding-top:130px;
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
        }

        .profile-btn{
            background:linear-gradient(135deg,#2563eb,#1e3a8a);
            color:white;
            border:none;
            padding:10px 18px;
            border-radius:14px;
        }

        .dropdown-content{
            position:absolute;
            right:0;
            top:65px;
            width:290px;
            background:white;
            border-radius:18px;
            display:none;
        }

        .dropdown-content.show{
            display:block;
        }
html, body {
    height: 100%;
    overflow-x: hidden;
}

/* IMPORTANT: permet le scroll */
.content {
    min-height: 100vh;
    overflow-y: auto;
    padding-bottom: 80px;
}

/* assure que le body peut scroller */
body {
    overflow-y: auto;
}

.sidebar {
    position: fixed;
    height: 100vh;
    overflow-y: auto;
}

.header {
    position: fixed;
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

/* dropdown container */
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

/* links */
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

/* logout button */
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

/* animation */
@keyframes fadeIn{
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
    </style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="logo-box">
        <img src="{{ asset('images/ems-logo.png') }}">
        <h2>EMS Sénégal</h2>
        <p>Gestion des Clients</p>
    </div>

    @if(Auth::user()->role === 'admin')

        <a href="/admin/dashboard">Dashboard</a>
        <a href="/users">Utilisateurs</a>
        <a href="/clients">Clients</a>
        <a href="/reservations">Réservations</a>
        <a href="/factures">Factures</a>
        <a href="/paiements">Paiements</a>
        <a href="/versements">Versements</a>
        <a href="/bordereaux">Bordereaux</a>

    @else

        <a href="/user/dashboard">Dashboard</a>
        <a href="/users">Utilisateurs</a>
        <a href="/clients">Clients</a>
        <a href="/reservations">Réservations</a>
        <a href="/factures">Factures</a>
        <a href="/paiements">Paiements</a>

    @endif

</div>

<!-- HEADER -->
<div class="header">

    <h3>EMS Gestion Clients</h3>

    <div style="position:relative">

        <button class="profile-btn" onclick="toggleMenu()">
            {{ Auth::user()->name }}
        </button>

        <div class="dropdown-content" id="profileDropdown">

    <a href="/profile">Mon profil</a>

    <a href="/modifier-mot-de-passe"> Changer mot de passe</a>

    <hr style="margin:0">

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Déconnexion</button>
    </form>

</div>
    </div>

</div>

<!-- CONTENT -->
<div class="content">
    @yield('content')
</div>

<script>
function toggleMenu(){
    document.getElementById("profileDropdown").classList.toggle("show");
}
</script>

</body>
</html>

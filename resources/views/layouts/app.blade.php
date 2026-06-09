<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS Voyage - Système de Gestion</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* ===== RESET & BASE ===== */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --sidebar-w: 270px;
            --topbar-h: 80px; /* Légèrement augmenté pour le confort du logo */
            --blue-deep: #0f2a6b;
            --blue-mid: #1e3a8a;
            --blue-brand: #2563eb;
            --orange: #f97316;
            --bg-page: #f4f7ff;
            --bg-card: #ffffff;
            --border: rgba(0,0,0,0.07);
            --text-primary: #0f172a;
            --text-muted: #64748b;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
        }

        html, body {
            height: 100%;
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: var(--bg-page);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        body {
            display: flex;
        }

        /* ===== SIDEBAR REAJUSTÉE (DÉBUTE SOUS LA TOPBAR) ===== */
        .sidebar {
            width: var(--sidebar-w);
            height: calc(100vh - var(--topbar-h));
            background: linear-gradient(180deg, var(--blue-deep), var(--blue-mid), var(--blue-brand));
            color: white;
            padding: 20px;
            position: fixed;
            left: 0;
            top: var(--topbar-h);
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 5px 5px 25px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
        }

        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 4px; }

        .sidebar-heading {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #93c5fd;
            font-weight: 700;
            margin-top: 18px;
            padding-left: 10px;
            margin-bottom: 4px;
            opacity: 0.8;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            padding: 11px 14px;
            margin: 3px 0;
            border-radius: var(--radius-md);
            font-size: 14px;
            transition: all 0.2s ease;
            background: rgba(255,255,255,0.04);
        }

        .sidebar a i {
            font-size: 18px;
            color: rgba(255,255,255,0.55);
            transition: color 0.2s;
        }

        .sidebar a:hover {
            background: var(--orange);
            transform: translateX(5px);
            color: white;
        }

        .sidebar a:hover i { color: white; }

        .sidebar a.active {
            background: var(--orange);
            color: white;
            font-weight: 600;
        }

        .sidebar a.active i { color: white; }

        /* ===== TOPBAR (HEADER COMPLET SUR TOUTE LA LARGEUR) ===== */
        .header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: var(--topbar-h);
    background: linear-gradient(90deg,#0f2a6b,#1e3a8a,#2563eb);
    padding: 0 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 1001;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

        /* Partie gauche : Logo EMS aligné avec le Titre */
        .topbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo-box-inline {
    display: flex;
    align-items: center;
    gap: 12px;
    width: calc(var(--sidebar-w) - 24px);
    padding-right: 20px;
}

        .logo-box-inline img {
    width: 50px;
    height: 50px;
    object-fit: contain;
    background: rgb(255, 255, 255);
    padding: 6px;
    border-radius: 12px;
}

       .logo-box-inline .logo-text h2 {
    font-size: 18px;
    font-weight: 700;
    color: white;
    margin: 0;
}

        .logo-box-inline .logo-text p {
    font-size: 12px;
    color: #dbeafe;
    margin: 0;
}

       .header h3 {
    color: white;
    font-size: 16px;
    font-weight: 600;
    margin: 0;
}

        /* Partie droite : Recherche, Cloche et Profil */
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 6px;
            background: var(--bg-page);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 6px 12px;
        }

        .search-box i { font-size: 15px; color: var(--text-muted); }
        .search-box {
    display: flex;
    align-items: center;
    gap: 6px;
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 10px;
    padding: 6px 12px;
}
.search-box input {
    border: none;
    background: transparent;
    outline: none;
    color: white;
    width: 150px;
}

.search-box input::placeholder {
    color: rgba(255,255,255,0.7);
}

       .icon-btn {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.15);
    background: rgba(255,255,255,0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.icon-btn i {
    color: white;
}

        .icon-btn:hover { background: var(--bg-page); }
        .icon-btn i { font-size: 18px; color: var(--text-muted); }

        .notif-dot {
            width: 8px;
            height: 8px;
            background: var(--orange);
            border-radius: 50%;
            position: absolute;
            top: 7px;
            right: 8px;
            border: 1.5px solid white;
        }

       .profile-pill {
    display: flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg,#2563eb,#f97316);
    border: none;
    border-radius: 12px;
    padding: 8px 14px;
    cursor: pointer;
    transition: 0.3s;
    position: relative;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

.profile-pill:hover{
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}
.profile-pill i.chevron {
    color: white;
}
.profile-pill:hover {
    background: rgba(255,255,255,0.20);
}
        .profile-pill:hover { background: #e2e8f0; }

       .profile-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: white;
    color: #1e3a8a;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
}
    .profile-name {
    color: white;
    font-weight: 600;
}
        /* Dropdown */
       .dropdown-content {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    width: 250px;
    background: linear-gradient(180deg,#0f2a6b,#1e3a8a,#2563eb);
    border-radius: 16px;
    overflow: hidden;
    display: none;
    z-index: 9999;
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    border: 2px solid #f97316;
}

.dropdown-content.show {
    display: block;
}

.dd-header {
    padding: 15px;
    background: #f97316;
    color: white;
}

.dd-header .dd-name {
    font-size: 14px;
    font-weight: 700;
}

.dd-header .dd-email {
    font-size: 12px;
    opacity: 0.9;
}

.dropdown-content a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 16px;
    text-decoration: none;
    color: white;
    font-size: 14px;
    transition: 0.3s;
    border-bottom: 1px solid rgba(255,255,255,0.08);
}

.dropdown-content a:hover {
    background: #f97316;
    color: white;
    padding-left: 22px;
}

.dropdown-content a i {
    color: #f97316;
}

.dropdown-content a:hover i {
    color: white;
}

.dropdown-divider {
    height: 1px;
    background: rgba(255,255,255,0.15);
}

.logout-btn {
    width: 100%;
    border: none;
    background: transparent;
    color: #ffb4b4;
    padding: 14px 16px;
    text-align: left;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: 0.3s;
}

.logout-btn:hover {
    background: #dc2626;
    color: white;
    padding-left: 22px;
}

.logout-btn i {
    color: #ffb4b4;
}


        /* ===== ZONE DE CONTENU ===== */
        .content {
            margin-left: var(--sidebar-w);
            width: calc(100% - var(--sidebar-w));
            padding: 24px;
            padding-top: calc(var(--topbar-h) + 24px);
            min-height: 100vh;
        }

        .content.full-width {
            margin-left: 0 !important;
            width: 100% !important;
            padding-top: 24px !important;
        }
    </style>
</head>

<body>

@php
    $user = Auth::user();
    $initials = '--';
    if ($user) {
        $nameParts = explode(' ', $user->name);
        $initials = strtoupper(
            substr($nameParts[0] ?? '', 0, 1) .
            substr($nameParts[1] ?? '', 0, 1)
        );
    }
@endphp

@if($user)
<div class="header">
    <div class="topbar-left">
        <div class="logo-box-inline">
            <img src="{{ asset('images/ems-logo.png') }}" alt="Logo EMS">
            <div class="logo-text">
                <h2>EMS Voyage</h2>
                <p>Gestion Systèmes</p>
            </div>
        </div>

        <h3>Espace
            @if($user->role === 'administrateur')
                Administration Système
            @elseif($user->role === 'chef_agence')
                Direction
            @elseif($user->role === 'comptable')
                Comptabilité
            @elseif($user->role === 'agent_comptoir')
                Saisie Comptoir
            @endif
        </h3>
    </div>

    <div class="topbar-right">
        <div class="search-box d-none d-md-flex">
            <i class="ti ti-search"></i>
            <input type="text" placeholder="Rechercher...">
        </div>

        <div class="icon-btn">
            <i class="ti ti-bell"></i>
            <span class="notif-dot"></span>
        </div>

        <div class="profile-pill" onclick="toggleMenu(event)">
            <div class="profile-avatar">
                {{ $initials }}
            </div>
            <span class="profile-name">{{ $user->name }}</span>
            <i class="ti ti-chevron-down chevron"></i>

            <div class="dropdown-content" id="profileDropdown">
                <div class="dd-header">
                    <div class="dd-name">{{ $user->name }}</div>
                    <div class="dd-email">{{ $user->email }}</div>
                </div>

                <a href="/profile">
                    <i class="ti ti-user"></i> Mon profil
                </a>

                <a href="/change-password">
                    <i class="ti ti-lock"></i> Changer mot de passe
                </a>

                <div class="dropdown-divider"></div>

                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="logout-btn" onclick="return confirm('Voulez-vous vraiment vous déconnecter ?')">
                        <i class="ti ti-logout"></i> Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="sidebar">
    <div class="sidebar-heading">Principal</div>
    <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
        <i class="ti ti-layout-dashboard"></i> Dashboard Accueil
    </a>

    {{-- ROLE ADMINISTRATEUR --}}
    @if($user->role === 'administrateur')
        <div class="sidebar-heading" style="color: #ef4444;">Administration</div>
        <a href="/users" class="{{ request()->is('users*') ? 'active' : '' }}">
            <i class="ti ti-users-gear"></i> Gérer les utilisateurs
        </a>
    @endif

    {{-- ROLE CHEF AGENCE --}}
    @if($user->role === 'chef_agence')
        <div class="sidebar-heading"></div>
        <a href="/clients" class="{{ request()->is('clients*') ? 'active' : '' }}">
            <i class="ti ti-user-circle"></i> Base Clients
        </a>
        <a href="/reservations" class="{{ request()->is('reservations*') ? 'active' : '' }}">
            <i class="ti ti-calendar-event"></i> Réservations globales
        </a>
        <a href="/factures" class="{{ request()->is('factures*') ? 'active' : '' }}">
            <i class="ti ti-file-invoice"></i> Suivi des factures
        </a>
        <a href="/bordereaux" class="{{ request()->is('bordereaux*') ? 'active' : '' }}">
            <i class="ti ti-clipboard-list"></i> Tous les Bordereaux
        </a>
        <a href="/versements" class="{{ request()->is('versements*') ? 'active' : '' }}">
            <i class="ti ti-cash"></i> Versements Banque
        </a>

    @endif

    {{-- ROLE COMPTABLE --}}
    @if($user->role === 'comptable')
        <div class="sidebar-heading">Gestion Financière</div>
        <a href="/factures" class="{{ request()->is('factures*') ? 'active' : '' }}">
            <i class="ti ti-file-analytics"></i> Factures à valider
        </a>
        <a href="/paiements" class="{{ request()->is('paiements*') ? 'active' : '' }}">
            <i class="ti ti-credit-card"></i> Suivi des Paiements
        </a>
        <a href="/bordereaux" class="{{ request()->is('bordereaux*') ? 'active' : '' }}">
            <i class="ti ti-clipboard-check"></i> Bordereaux d'envoi
        </a>
        <a href="/versements" class="{{ request()->is('versements*') ? 'active' : '' }}">
            <i class="ti ti-building-bank"></i> Versements Banque
        </a>
    @endif

    {{-- ROLE AGENT COMPTOIR --}}
    @if($user->role === 'agent_comptoir')
        <div class="sidebar-heading">Opérations Guichet</div>
        <a href="/clients" class="{{ request()->is('clients*') ? 'active' : '' }}">
            <i class="ti ti-user-plus"></i> Gestion Clients
        </a>
        <a href="/reservations" class="{{ request()->is('reservations*') ? 'active' : '' }}">
            <i class="ti ti-calendar-plus"></i> Prise de Réservation
        </a>
        <a href="/factures" class="{{ request()->is('factures*') ? 'active' : '' }}">
            <i class="ti ti-file-text"></i> Émettre une Facture
        </a>
        <a href="/paiements" class="{{ request()->is('paiements*') ? 'active' : '' }}">
            <i class="ti ti-coin"></i> Saisir un paiement
        </a>
    @endif
</div>
@endif

<div class="content {{ !$user ? 'full-width' : '' }}">
    @yield('content')
</div>

<script>
function toggleMenu(e){
    e.stopPropagation();
    document.getElementById("profileDropdown").classList.toggle("show");
}

document.addEventListener('click', function () {
    let dd = document.getElementById('profileDropdown');
    if (dd) dd.classList.remove('show');
});
</script>

</body>
</html>

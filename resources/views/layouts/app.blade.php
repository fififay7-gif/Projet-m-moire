<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS - Gestion de Stock</title>

    <!-- BOOTSTRAP -->
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

        /* ================= SIDEBAR ================= */

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

        /* LOGO */

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
            box-shadow:0 10px 25px rgba(0,0,0,0.2);
            margin-bottom:15px;
        }

        .logo-box h2{
            font-size:20px;
            font-weight:bold;
            line-height:1.4;
            color:white;
        }

        .logo-box p{
            color:#dbeafe;
            font-size:13px;
            margin-top:5px;
        }

        /* MENU */

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
            color:white;
            box-shadow:0 8px 20px rgba(249,115,22,0.35);
        }

        /* ================= CONTENT ================= */

        .content{
            margin-left:270px;
            width:calc(100% - 270px);
            padding:30px;
            padding-top:130px;
        }

        /* ================= HEADER FIXE ================= */

        .header{
            position:fixed;
            top:0;
            left:270px;
            width:calc(100% - 270px);

            background:white;
            padding:18px 30px;
            z-index:999;

            display:flex;
            justify-content:space-between;
            align-items:center;

            border-bottom:1px solid #e5e7eb;

            box-shadow:0 8px 25px rgba(0,0,0,0.08);
        }

        .header-left{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .header-logo{
            width:55px;
            height:55px;
            object-fit:contain;
            background:#f8fbff;
            padding:6px;
            border-radius:12px;
            border:2px solid #dbeafe;
        }

        .header h3{
            color:#1e3a8a;
            font-size:22px;
            font-weight:bold;
            margin:0;
        }

        .header p{
            margin:0;
            color:#64748b;
            font-size:13px;
        }

        /* ================= PROFILE ================= */

        .profile-menu{
            position:relative;
        }

        .profile-btn{
            background:linear-gradient(135deg,#2563eb,#1e3a8a);
            color:white;
            border:none;
            padding:10px 18px;
            border-radius:14px;
            cursor:pointer;
            font-weight:bold;
            display:flex;
            align-items:center;
            gap:10px;
            transition:0.3s;
            box-shadow:0 8px 20px rgba(37,99,235,0.25);
        }

        .profile-btn:hover{
            transform:translateY(-2px);
        }

        .profile-avatar{
            width:35px;
            height:35px;
            background:#f97316;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:14px;
            font-weight:bold;
            color:white;
        }

        /* ================= DROPDOWN ================= */

        .dropdown-content{
            position:absolute;
            right:0;
            top:65px;
            width:290px;
            background:white;
            border-radius:18px;
            overflow:hidden;
            display:none;
            z-index:1000;
            box-shadow:0 15px 40px rgba(0,0,0,0.15);
        }

        .dropdown-content.show{
            display:block;
            animation:fadeIn 0.2s ease;
        }

        @keyframes fadeIn{
            from{
                opacity:0;
                transform:translateY(-10px);
            }

            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        .profile-top{
            background:linear-gradient(135deg,#1e3a8a,#2563eb);
            padding:22px;
            color:white;
            text-align:center;
        }

        .profile-top .big-avatar{
            width:70px;
            height:70px;
            background:#f97316;
            border-radius:50%;
            margin:auto;
            margin-bottom:12px;

            display:flex;
            justify-content:center;
            align-items:center;

            font-size:28px;
            font-weight:bold;
        }

        .profile-top h4{
            margin-bottom:5px;
        }

        .profile-top p{
            font-size:13px;
            opacity:0.9;
        }

        .dropdown-content a{
            display:block;
            padding:15px 20px;
            text-decoration:none;
            color:#1e3a8a;
            font-weight:500;
            transition:0.3s;
        }

        .dropdown-content a:hover{
            background:#f4f7ff;
            padding-left:25px;
            color:#f97316;
        }

        .dropdown-divider{
            height:1px;
            background:#eee;
        }

        .logout-dropdown{
            width:100%;
            border:none;
            background:white;
            color:#dc2626;
            text-align:left;
            padding:15px 20px;
            font-weight:bold;
            transition:0.3s;
        }

        .logout-dropdown:hover{
            background:#ffe5e5;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width:900px){

            .sidebar{
                width:230px;
            }

            .content{
                margin-left:230px;
                width:calc(100% - 230px);
            }

            .header{
                left:230px;
                width:calc(100% - 230px);
            }

        }

    </style>

</head>

<body>

    <!-- ================= SIDEBAR ================= -->

    <div class="sidebar">

        <!-- LOGO -->
        <div class="logo-box">

            <!-- METTRE LE LOGO EMS -->
            <img src="{{ asset('images/ems-logo.png') }}" alt="EMS Logo">

            <h2>
                EMS Sénégal
            </h2>

            <p>
                Gestion de Stock IA
            </p>

        </div>

        <!-- MENU -->

        @if(Auth::user()->role === 'admin')

            <a href="/admin/dashboard">
                 Dashboard
            </a>

            <a href="/produits">
                 Produits
            </a>

            <a href="/mouvements">
                 Entrées / Sorties
            </a>

            <a href="/stocks">
                 Gestion Stock
            </a>

            <a href="/users">
                 Utilisateurs
            </a>

        @else

            <a href="/user/dashboard">
                 Dashboard
            </a>

            <a href="/produits">
                 Produits
            </a>

            <a href="/stocks">
                 Gestion Stock
            </a>

            <a href="/mouvements">
                 Mouvements
            </a>

            <a href="/alertes">
                 Alertes
            </a>

        @endif

    </div>

    <!-- ================= HEADER FIXE ================= -->

    <div class="header">

        <div class="header-left">

            <img src="{{ asset('images/ems-logo.png') }}"
                 class="header-logo"
                 alt="EMS">

            <div>

                <h3>
                    Bienvenue dans EMS Gestion de Stock
                </h3>

                <p>
                    Plateforme intelligente de gestion des stocks EMS Sénégal
                </p>

            </div>

        </div>

        <!-- PROFILE -->

        <div class="profile-menu">

            <button class="profile-btn" onclick="toggleMenu()">

                <div class="profile-avatar">
                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                </div>

                {{ Auth::user()->name }}

            </button>

            <!-- DROPDOWN -->

            <div class="dropdown-content" id="profileDropdown">

                <div class="profile-top">

                    <div class="big-avatar">
                        {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                    </div>

                    <h4>
                        {{ Auth::user()->name }}
                    </h4>

                    <p>
                        {{ Auth::user()->email }}
                    </p>

                </div>

                <a href="/profile">
                     Mon profil
                </a>

                <a href="/modifier-mot-de-passe">
                     Modifier mot de passe
                </a>

                <div class="dropdown-divider"></div>

                <form method="POST" action="/logout">

                    @csrf

                    <button type="submit" class="logout-dropdown">
                         Déconnexion
                    </button>

                </form>

            </div>

        </div>

    </div>

    <!-- ================= CONTENT ================= -->

    <div class="content">

        @yield('content')

    </div>

    <!-- ================= SCRIPT ================= -->

    <script>

        function toggleMenu(){

            document
                .getElementById("profileDropdown")
                .classList.toggle("show");

        }

        window.onclick = function(event){

            if(!event.target.closest('.profile-menu')){

                document
                    .getElementById("profileDropdown")
                    .classList.remove("show");

            }

        }

    </script>

</body>
</html>

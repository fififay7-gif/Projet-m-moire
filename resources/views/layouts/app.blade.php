<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Stock IA</title>

    <style>

        /*  GLOBAL */
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            font-family: Arial, sans-serif;
            background-color: #f0f4ff;
            display: flex;
        }

        /*  SIDEBAR */
        .sidebar{
            width: 250px;
            min-height: 100vh;
            background: linear-gradient(180deg, #1e3a8a, #2563eb);
            color: white;
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar h2{
            text-align: center;
            margin-bottom: 40px;
            font-size: 24px;
        }

        .sidebar a{
            display: block;
            color: white;
            text-decoration: none;
            padding: 14px;
            margin: 10px 0;
            border-radius: 10px;
            transition: 0.3s;
            font-size: 15px;
        }

        .sidebar a:hover{
            background: rgba(255,255,255,0.2);
            transform: translateX(5px);
        }

        /*  LOGOUT */
        .logout-btn{
            width: 100%;
            border: none;
            background: #2563eb;
            color: white;
            padding: 12px;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 30px;
            font-size: 15px;
            font-weight: bold;
            transition: 0.3s;
        }

        .logout-btn:hover{
            background: #dc2626;
        }

        /*  CONTENT */
        .content{
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 30px;
        }

        /*  HEADER */
        .header{
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h3{
            color: #1e3a8a;
        }

        .role{
            background: #dbeafe;
            color: #1e3a8a;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
        }

        /*  CARD GLOBAL */
        .card{
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }

    </style>
</head>

<body>

    <!--  SIDEBAR -->
    <div class="sidebar">

        <h2>Gestion de Stock IA</h2>

        {{--  ADMIN --}}
        @if(Auth::user()->role === 'admin')

            <a href="/admin/dashboard"> Dashboard</a>

           <a href="/produits"> Produits</a>

             <a href="/mouvements"> Entrées / Sorties</a>

            <a href="/stocks">Gérer Stock</a>

            <a href="/users"> Gérer utilisateurs</a>
        {{--  USER --}}

@else

    <a href="/user/dashboard"> Dashboard</a>

    <a href="/produits"> Produits</a>

    <a href="/stocks">Gérer Stock</a>

    <a href="/mouvements"> Entrées / Sorties</a>

    <a href="/alertes"> Alertes Stock</a>

    <a href="/fiche-ia"> Générer Fiche IA</a>

@endif
        <!--  LOGOUT -->
        <form method="POST" action="/logout">
            @csrf

            <button class="logout-btn">
                Déconnexion
            </button>
        </form>

    </div>

    <!--  CONTENT -->
    <div class="content">

        <!--  HEADER -->
        <div class="header">

            <h3>
                Bienvenue {{ Auth::user()->name }}
            </h3>

            <div class="role">
                {{ Auth::user()->role }}
            </div>

        </div>

        <!--  CONTENU -->
        @yield('content')

    </div>

</body>

</html>

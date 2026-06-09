<!DOCTYPE html>
<html>
<head>
    <title>Connexion EMS</title>

    <style>

        :root{
            --blue:#1e3a8a;
            --blue2:#2563eb;
            --orange:#f97316;
            --bg:#f6f8fc;
        }

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            background:linear-gradient(135deg,#eef3ff,#ffffff);
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .login-container{
            background:white;
            padding:40px;
            border-radius:16px;
            box-shadow:0 10px 30px rgba(0,0,0,0.08);
            width:360px;
            text-align:center;
            border-top:5px solid var(--blue);
        }

        /* LOGO */
        .logo{
            width:70px;
            height:70px;
            margin:0 auto 15px;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .logo img{
            width:60px;
            height:60px;
            object-fit:contain;
        }

        /* TITRE */
        h2{
            color:var(--blue);
            margin-bottom:6px;
        }

        .subtitle{
            font-size:13px;
            color:#64748b;
            margin-bottom:20px;
        }

        /* INPUT */
        input{
            width:100%;
            padding:12px;
            margin:10px 0;
            border:1px solid #dbeafe;
            border-radius:10px;
            outline:none;
            background:#f8fbff;
            transition:0.2s;
        }

        input:focus{
            border-color:var(--blue2);
            box-shadow:0 0 0 3px rgba(37,99,235,0.1);
        }

        /* BUTTON */
        button{
            width:100%;
            padding:12px;
            background:var(--orange);
            color:white;
            border:none;
            border-radius:10px;
            cursor:pointer;
            font-weight:bold;
            transition:0.2s;
            margin-top:10px;
        }

        button:hover{
            background:#ea580c;
            transform:translateY(-1px);
        }

        /* ERROR */
        .error{
            color:#dc2626;
            background:#fee2e2;
            padding:10px;
            border-radius:8px;
            margin-bottom:10px;
            font-size:13px;
        }

    </style>

</head>

<body>

<div class="login-container">

    <!-- LOGO -->
    <div class="logo">
        <img src="/images/Ems-Logo.png" alt="EMS Logo">
    </div>

    <h2>Connexion</h2>
    <div class="subtitle">Gestion des clients EMS Sénégal</div>

    @if($errors->any())
        <p class="error">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="/login">
        @csrf

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Mot de passe" required>

        <button type="submit">Se connecter</button>
    </form>

</div>

</body>
</html>

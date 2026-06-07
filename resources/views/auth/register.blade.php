<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un utilisateur EMS</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body{
            background: linear-gradient(135deg,#eef2ff,#f5f7fb);
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
        }

        .register-container{
            background:white;
            padding:35px;
            border-radius:18px;
            box-shadow:0 15px 40px rgba(0,0,0,0.08);
            width:420px;
        }

        h2{
            text-align:center;
            color:#1e3a8a;
            margin-bottom:25px;
            font-weight:bold;
        }

        input, select{
            width:100%;
            padding:12px;
            margin-top:8px;
            margin-bottom:15px;
            border:1px solid #e5e7eb;
            border-radius:10px;
            outline:none;
            font-size:14px;
            background:#f9fafb;
        }

        input:focus, select:focus{
            border-color:#2563eb;
            box-shadow:0 0 0 3px rgba(37,99,235,0.15);
            background:white;
        }

        .success{
            background:#dcfce7;
            color:#166534;
            padding:10px;
            border-radius:10px;
            margin-bottom:15px;
            border-left:4px solid #22c55e;
        }

        .error{
            color:#dc2626;
            font-size:13px;
            margin-top:-10px;
            margin-bottom:10px;
        }

        .buttons{
            display:flex;
            gap:12px;
            margin-top:15px;
        }

        .create-btn{
            flex:1;
            padding:12px;
            background: linear-gradient(135deg,#2563eb,#1e3a8a);
            color:white;
            border:none;
            border-radius:10px;
            cursor:pointer;
            font-weight:bold;
        }

        .cancel-btn{
            flex:1;
            padding:12px;
            background:#f97316;
            color:white;
            text-align:center;
            text-decoration:none;
            border-radius:10px;
            font-weight:bold;
            display:flex;
            justify-content:center;
            align-items:center;
        }

    </style>
</head>

<body>

<div class="register-container">

    <h2>Créer un utilisateur EMS</h2>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/register">
        @csrf

        <!-- NOM -->
        <input type="text" name="name" placeholder="Nom complet" value="{{ old('name') }}">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- EMAIL -->
        <input type="email" name="email" placeholder="Adresse email" value="{{ old('email') }}">
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- PASSWORD -->
        <input type="password" name="password" placeholder="Mot de passe">
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- CONFIRM PASSWORD -->
        <input type="password" name="password_confirmation" placeholder="Confirmer mot de passe">

        <!-- ROLE (CORRIGÉ) -->
        <select name="role" required>
            <option value="agent_de_comptoir">Agent de comptoir</option>
            <option value="chef_agence">Chef d’agence</option>
            <option value="comptable">Comptable</option>
        </select>

        @error('role')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- BUTTONS -->
        <div class="buttons">

            <button type="submit" class="create-btn">
                Créer utilisateur
            </button>

            <a href="/users" class="cancel-btn">
                Annuler
            </a>

        </div>

    </form>

</div>

</body>

</html>

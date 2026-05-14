<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un utilisateur</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e6f0ff, #ffffff);
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .register-container{
            background:white;
            padding:40px;
            border-radius:15px;
            box-shadow:0 8px 20px rgba(0,0,0,0.1);
            width:400px;
        }

        h2{
            text-align:center;
            color:#1e3a8a;
            margin-bottom:25px;
        }

        input,
        select{
            width:100%;
            padding:12px;
            margin-top:8px;
            margin-bottom:15px;
            border:1px solid #cbd5e1;
            border-radius:8px;
            outline:none;
            font-size:14px;
        }

        input:focus,
        select:focus{
            border-color:#2563eb;
        }

        .success{
            background:#dcfce7;
            color:green;
            padding:10px;
            border-radius:8px;
            margin-bottom:15px;
        }

        .error{
            color:red;
            font-size:13px;
            margin-top:-10px;
            margin-bottom:10px;
        }

        /*  BUTTONS */
        .buttons{
            display:flex;
            gap:10px;
            margin-top:15px;
        }

        .create-btn{
            flex:1;
            padding:12px;
            background:#2563eb;
            color:white;
            border:none;
            border-radius:8px;
            cursor:pointer;
            font-weight:bold;
            font-size:14px;
            transition:0.3s;
        }

        .create-btn:hover{
            background:#1e3a8a;
        }

        .cancel-btn{
            flex:1;
            padding:12px;
            background:#dc2626;
            color:white;
            text-align:center;
            text-decoration:none;
            border-radius:8px;
            font-weight:bold;
            transition:0.3s;
        }

        .cancel-btn:hover{
            background:#991b1b;
        }

    </style>

</head>

<body>

<div class="register-container">

    <h2>Créer un utilisateur</h2>

    <!--  MESSAGE SUCCESS -->
    @if(session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif

    <form method="POST" action="/register">

        @csrf

        <!--  NOM -->
        <input type="text"
               name="name"
               placeholder="Nom complet"
               value="{{ old('name') }}">

        @error('name')
            <div class="error">
                {{ $message }}
            </div>
        @enderror

        <!--  EMAIL -->
        <input type="email"
               name="email"
               placeholder="Adresse email"
               value="{{ old('email') }}">

        @error('email')
            <div class="error">
                {{ $message }}
            </div>
        @enderror

        <!--  PASSWORD -->
        <input type="password"
               name="password"
               placeholder="Mot de passe">

        @error('password')
            <div class="error">
                {{ $message }}
            </div>
        @enderror

        <!--  CONFIRM PASSWORD -->
        <input type="password"
               name="password_confirmation"
               placeholder="Confirmer mot de passe">

        <!--  ROLE -->
        <select name="role">

            <option value="user">
                Utilisateur
            </option>

            <option value="admin">
                Administrateur
            </option>

        </select>

        @error('role')
            <div class="error">
                {{ $message }}
            </div>
        @enderror

        <!--  BUTTONS -->
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

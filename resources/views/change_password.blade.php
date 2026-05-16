<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Changer mot de passe</title>

    <style>

        body{
            font-family:Arial;
            background:#f0f4ff;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .box{
            background:white;
            padding:40px;
            border-radius:15px;
            width:400px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }

        h2{
            text-align:center;
            color:#1e3a8a;
            margin-bottom:20px;
        }

        input{
            width:100%;
            padding:12px;
            margin-top:10px;
            margin-bottom:15px;
            border:1px solid #ccc;
            border-radius:8px;
        }

        button{
            width:100%;
            padding:12px;
            border:none;
            background:#2563eb;
            color:white;
            border-radius:8px;
            font-weight:bold;
            cursor:pointer;
        }

        button:hover{
            background:#1e3a8a;
        }

        .error{
            color:red;
            font-size:14px;
        }

    </style>

</head>

<body>

<div class="box">

    <h2>
        Changer votre mot de passe
    </h2>

    <form method="POST" action="/change-password">

        @csrf

        <input type="password"
               name="password"
               placeholder="Nouveau mot de passe">

        @error('password')
            <div class="error">
                {{ $message }}
            </div>
        @enderror

        <input type="password"
               name="password_confirmation"
               placeholder="Confirmer mot de passe">

        <button type="submit">

            Enregistrer

        </button>

    </form>

</div>

</body>

</html>

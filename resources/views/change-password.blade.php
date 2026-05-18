<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>Changer mot de passe</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial, sans-serif;
            background:linear-gradient(135deg,#eef4ff,#ffffff);
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        /* BOX */
        .box{
            background:white;
            padding:40px;
            width:430px;
            border-radius:20px;
            box-shadow:0 10px 30px rgba(0,0,0,0.08);
            border-top:5px solid #ff6a00;
        }

        /* TITLE */
        h2{
            color:#1e3a8a;
            text-align:center;
            margin-bottom:10px;
            font-size:28px;
        }

        .subtitle{
            text-align:center;
            color:#64748b;
            margin-bottom:25px;
            font-size:14px;
        }

        /* INPUTS */
        input{
            width:100%;
            padding:14px;
            margin-bottom:15px;
            border:1px solid #dbeafe;
            border-radius:10px;
            outline:none;
            font-size:14px;
            transition:0.3s;
            background:#f8fbff;
        }

        input:focus{
            border-color:#2563eb;
            box-shadow:0 0 0 3px rgba(37,99,235,0.1);
        }

        /* BUTTON */
        button{
            width:100%;
            padding:14px;
            background:linear-gradient(135deg,#ff6a00,#e65c00);
            color:white;
            border:none;
            border-radius:10px;
            cursor:pointer;
            font-weight:bold;
            font-size:15px;
            transition:0.3s;
            box-shadow:0 5px 15px rgba(255,106,0,0.25);
        }

        button:hover{
            transform:translateY(-2px);
            box-shadow:0 8px 20px rgba(255,106,0,0.35);
        }

        /* ERROR */
        .error{
            background:#fee2e2;
            color:#dc2626;
            padding:10px;
            border-radius:8px;
            margin-bottom:15px;
            font-size:14px;
        }

        /* ICON */
        .icon{
            width:70px;
            height:70px;
            background:linear-gradient(135deg,#2563eb,#1e3a8a);
            border-radius:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            margin:auto;
            margin-bottom:20px;
            color:white;
            font-size:30px;
            box-shadow:0 8px 20px rgba(37,99,235,0.25);
        }

    </style>

</head>

<body>

<div class="box">

    <div class="icon">
        
    </div>

    <h2>
        Nouveau mot de passe
    </h2>

    <p class="subtitle">
        Pour sécuriser votre compte EMS,
        veuillez modifier votre mot de passe.
    </p>

    <form method="POST" action="/change-password">

        @csrf

        <!-- PASSWORD -->
        <input type="password"
               name="password"
               placeholder="Nouveau mot de passe">

        @error('password')

            <div class="error">
                {{ $message }}
            </div>

        @enderror

        <!-- CONFIRM -->
        <input type="password"
               name="password_confirmation"
               placeholder="Confirmer mot de passe">

        <!-- BUTTON -->
        <button type="submit">

            Modifier mot de passe

        </button>

    </form>

</div>

</body>
</html>

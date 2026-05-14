<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e6f0ff, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            width: 320px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #1e66d0;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #cce0ff;
            border-radius: 6px;
            outline: none;
        }

        input:focus {
            border-color: #1e66d0;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #1e66d0;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
        }

        button:hover {
            background-color: #1553a5;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .register-btn {
            display: block;
            margin-top: 15px;
            padding: 10px;
            border: 2px solid #1e66d0;
            color: #1e66d0;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .register-btn:hover {
            background-color: #1e66d0;
            color: white;
        }
    </style>

</head>
<body>

<div class="login-container">

    <h2>Connexion</h2>

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

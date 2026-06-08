<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un utilisateur EMS Voyage</title>

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
            margin-bottom:5px;
            font-weight:bold;
        }

        .subtitle {
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 25px;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            color: #4b5563;
            margin-left: 2px;
        }

        input, select{
            width:100%;
            padding:12px;
            margin-top:6px;
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
            font-size: 14px;
        }

        .error{
            color:#dc2626;
            font-size:13px;
            margin-top:-12px;
            margin-bottom:12px;
            padding-left: 2px;
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
            transition: 0.2s;
        }

        .create-btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
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
            transition: 0.2s;
        }

        .cancel-btn:hover {
            background: #ea580c;
            transform: translateY(-1px);
        }
    </style>
</head>

<body>

<div class="register-container">

    <h2>EMS Voyage</h2>
    <div class="subtitle">Espace d'ajout de personnel</div>

    @if(session('success'))
        <div class="success">
            ✅ {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/users/store">
        @csrf

        <label for="name">Nom complet de l'agent</label>
        <input type="text" id="name" name="name" placeholder="Ex: Pape Diop" value="{{ old('name') }}" required>
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="email">Adresse email</label>
        <input type="email" id="email" name="email" placeholder="Ex: p.diop@ems.sn" value="{{ old('email') }}" required>
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="role">Poste occupé (Rôle)</label>
        <select name="role" id="role" required>
            <option value="">-- Choisir un rôle --</option>
            <option value="administrateur" {{ old('role') == 'administrateur' ? 'selected' : '' }}>Administrateur Système</option>
            <option value="chef_agence" {{ old('role') == 'chef_agence' ? 'selected' : '' }}>Chef d'agence</option>
            <option value="agent_comptoir" {{ old('role') == 'agent_comptoir' ? 'selected' : '' }}>Agent de comptoir</option>
            <option value="comptable" {{ old('role') == 'comptable' ? 'selected' : '' }}>Comptable</option>
        </select>
        @error('role')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="password">Mot de passe initial</label>
        <input type="password" id="password" name="password" placeholder="••••••••" required>
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="password_confirmation">Confirmer le mot de passe</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>

        <div class="buttons">
            <button type="submit" class="create-btn">
                Créer l'agent
            </button>
            <a href="/users" class="cancel-btn">
                Annuler
            </a>
        </div>

    </form>

</div>

</body>
</html>

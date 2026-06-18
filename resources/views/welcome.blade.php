<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS Voyage - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Fond plein écran */
        body, html { height: 100%; margin: 0; font-family: 'Segoe UI', sans-serif; }

        .hero-bg {
            height: 100vh;
            background: linear-gradient(rgba(30, 58, 138, 0.7), rgba(30, 58, 138, 0.7)),
                        url('{{ asset("images/image.jfif") }}');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            color: white;
        }

        .navbar { padding: 20px 50px; background: rgba(255,255,255,0.1); backdrop-filter: blur(5px); }
        .main-content { flex: 1; display: flex; align-items: center; padding: 0 50px; }

        .hero-title { font-size: 3.5rem; font-weight: 800; line-height: 1.1; }
        .text-orange { color: #ff6a00; }

        .btn-ems { background: #ff6a00; color: white; padding: 15px 40px; border-radius: 8px; font-weight: bold; border: none; }
        .btn-ems:hover { background: #e65c00; color: white; }

        .info-card { background: rgba(255,255,255,0.95); color: #333; padding: 20px; border-radius: 10px; width: 250px; }
    </style>
</head>
<body>

<div class="hero-bg">
    <nav class="navbar navbar-expand-lg">
        <img src="{{ asset('images/logo-ems.jpeg') }}" height="50" alt="Logo">
        <div class="ms-auto d-flex gap-4">
            <span>Portail Agence</span><span>Réservations</span><span>Finance</span>
        </div>
    </nav>

    <div class="main-content">
        <div class="row w-100 align-items-center">
            <div class="col-lg-6">
                <h1 class="hero-title">Gestion Interne<br><span class="text-orange">EMS Voyage</span></h1>
                <p class="mt-3 lead">Accédez à votre espace de pilotage pour la gestion des clients et réservations.</p>
                <a href="/login" class="btn btn-ems mt-4">Accéder au portail →</a>

                <div class="d-flex gap-3 mt-5">
                    <div class="info-card">Sécurisé</div>
                    <div class="info-card">Performant</div>
                </div>
            </div>
            <div class="col-lg-6 text-end">
                <h2 class="display-4 fw-bold">Voyagez avec excellence.</h2>
                <p>Optimisez vos opérations avec le système de gestion le plus avancé.</p>
            </div>
        </div>
    </div>

    <footer class="text-center py-3" style="background: rgba(0,0,0,0.2);">
        &copy; 2026 EMS Voyage - Tous droits réservés
    </footer>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS Voyage — Gestion des Clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff; /* Le blanc domine sur le corps de page */
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* BARRE EN HAUT : EN BLEU ROYAL */
        .navbar-ems {
            background-color: #1e3a8a; /* Bleu EMS officiel */
            border-bottom: 3px solid #ff6a00; /* Fine ligne de séparation orange */
            padding: 12px 0;
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.15);
        }

        .main-hero {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 60px 0;
        }

        /* Titre principal */
        .hero-title {
            color: #1e3a8a;
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero-title span {
            color: #ff6a00;
        }

        .hero-text {
            font-size: 1.1rem;
            color: #475569;
            line-height: 1.6;
            margin-bottom: 35px;
        }

        /* Bouton d'action Orange EMS */
        .btn-ems-orange {
            background: linear-gradient(135deg, #ff6a00, #e65c00);
            color: white !important;
            font-weight: 700;
            font-size: 16px;
            padding: 14px 32px;
            border-radius: 12px;
            border: none;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 6px 20px rgba(255, 106, 0, 0.3);
        }

        .btn-ems-orange:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 106, 0, 0.4);
        }

        /* Zone de droite : Grille d'informations */
        .color-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
        }

        .color-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .icon-box-blue {
            width: 44px;
            height: 44px;
            background-color: #eff6ff;
            color: #1e3a8a;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            margin-bottom: 12px;
        }

        .icon-box-orange {
            width: 44px;
            height: 44px;
            background-color: #fff7ed;
            color: #ff6a00;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            margin-bottom: 12px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .card-text {
            font-size: 13.5px;
            color: #64748b;
            margin: 0;
        }

        .footer-ems {
            background-color: #1e3a8a;
            color: #ffffff;
            padding: 15px 0;
            font-size: 13px;
            border-top: 3px solid #ff6a00;
        }
    </style>
</head>
<body>
<nav class="navbar-ems">
    <div class="container d-flex justify-content-between align-items-center">

        <a href="/">
            <img src="{{ asset('images/ems-logo.png') }}" alt="EMS Voyage" style="height: 60px; width: auto; object-fit: contain;">
        </a>


    </div>
</nav>

    <main class="main-hero">
        <div class="container">
            <div class="row align-items-center g-5">

                <div class="col-lg-6">
                    <h1 class="hero-title">
                        Bienvenue dans la gestion des clients de <span>EMS Voyage</span>
                    </h1>
                    <p class="hero-text">
                        Sécurisez, centralisez et optimisez le suivi complet de vos dossiers voyageurs, fiches clients, abonnements et l'historique de leurs déplacements sur tout le réseau.
                    </p>

                    <a href="/login" class="btn-ems-orange">
                        <span>Ouvrir la session d'administration</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <div class="col-lg-6">
                    <div class="row g-3">

                        <div class="col-sm-6">
                            <div class="color-card" style="border-top: 4px solid #1e3a8a;">
                                <div class="icon-box-blue">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <h5 class="card-title">Portail Client</h5>
                                <p class="card-text">Fiches d'identité, coordonnées et gestion de la fidélité.</p>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="color-card" style="border-top: 4px solid #ff6a00;">
                                <div class="icon-box-orange">
                                    <i class="fa-solid fa-ticket"></i>
                                </div>
                                <h5 class="card-title">Réservations</h5>
                                <p class="card-text">Liaison automatique des billets émis avec le profil passager.</p>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="color-card" style="background-color: #f8fafc; border-left: 4px solid #137333;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="icon-box-blue" style="margin-bottom:0; background: white;">
                                        <i class="fa-solid fa-shield-halved" style="color: #137333;"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title" style="margin-bottom:2px;">Sécurité Maximale</h5>
                                        <p class="card-text">Authentification chiffrée conforme aux exigences de l'organisation.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>

    <footer class="footer-ems text-center">
        <div class="container text-white-50">
            &copy; 2026 <strong class="text-white">EMS Voyage</strong> — Espace d'administration technique et commercial interne.
        </div>
    </footer>

</body>
</html>

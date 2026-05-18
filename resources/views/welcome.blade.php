<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>EMS Sénégal - Gestion de Stock</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>

:root{
  --blue:#1e3a8a;
  --blue2:#2563eb;
  --orange:#f97316;
  --bg:#f6f8fc;
  --text:#0f172a;
  --muted:#64748b;
}

*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:Inter, sans-serif;
}

body{
  background:var(--bg);
  color:var(--text);
}

/* NAV */
nav{
  height:75px;
  background:white;
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:0 50px;
  border-bottom:1px solid #e5e7eb;
}

.logo{
  display:flex;
  align-items:center;
  gap:12px;
}

/* LOGO IMAGE */
.logo img{
  width:45px;
  height:45px;
  object-fit:contain;
}

/* TEXT LOGO */
.logo-text strong{
  color:var(--blue);
  font-size:16px;
}

.logo-text small{
  font-size:12px;
  color:var(--muted);
}

/* BUTTONS */
.btn{
  padding:10px 16px;
  border-radius:8px;
  text-decoration:none;
  font-weight:600;
  font-size:14px;
}

.btn-login{
  border:1px solid var(--blue);
  color:var(--blue);
}

.btn-login:hover{
  background:var(--blue);
  color:white;
}

.btn-primary{
  background:var(--orange);
  color:white;
}

.btn-primary:hover{
  background:#ea580c;
}

/* HERO CENTER */
.hero{
  min-height:calc(100vh - 75px);
  display:flex;
  justify-content:center;
  align-items:center;
  text-align:center;
  padding:40px;
}

.hero-box{
  max-width:800px;
}

.badge{
  display:inline-block;
  background:#e8eefc;
  color:var(--blue);
  padding:7px 14px;
  border-radius:20px;
  font-size:12px;
  margin-bottom:20px;
  font-weight:500;
}

.hero h1{
  font-size:52px;
  color:var(--blue);
  margin-bottom:20px;
  font-weight:700;
}

.hero h1 span{
  color:var(--orange);
}

.hero p{
  color:var(--muted);
  font-size:16px;
  line-height:1.8;
  margin-bottom:30px;
}

/* ACTION BUTTONS */
.actions{
  display:flex;
  justify-content:center;
  gap:15px;
}

/* FOOTER */
footer{
  text-align:center;
  padding:25px;
  color:var(--muted);
  font-size:13px;
  border-top:1px solid #e5e7eb;
}

</style>
</head>

<body>

<!-- NAV -->
<nav>

  <div class="logo">
    <!--  LOGO EMS ICI -->
    <img src="/images/Ems-Logo.png" alt="EMS Logo">

    <div class="logo-text">
      <strong>EMS Sénégal</strong><br>
      <small>Gestion de stock</small>
    </div>
  </div>

  <div>
    <a href="/login" class="btn btn-login">Connexion</a>
    <a href="/login" class="btn btn-primary">Accéder</a>
  </div>

</nav>

<!-- HERO CENTER -->
<section class="hero">

  <div class="hero-box">

    <div class="badge">Système officiel EMS Sénégal</div>

    <h1>
      Gestion de Stock<br>
      <span> intelligente</span>
    </h1>

    <p>
      Optimisez la gestion de vos produits, suivez vos mouvements de stock
      en temps réel et améliorez votre logistique avec une solution moderne
      conçue pour EMS Sénégal.
    </p>

    <div class="actions">
      <a href="/login" class="btn btn-primary">Se connecter</a>
      <a href="/login" class="btn btn-login">Connexion rapide</a>
    </div>

  </div>

</section>

<footer>
  © 2026 EMS Sénégal - Gestion de Stock | Tous droits réservés
</footer>

</body>
</html>

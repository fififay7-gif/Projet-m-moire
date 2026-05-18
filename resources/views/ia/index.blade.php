@extends('layouts.app')

@section('content')

<style>

body{
    background:#f5f7fb;
}

/* PAGE TITLE */
.page-title{
    color:#1e3a8a;
    font-size:32px;
    font-weight:bold;
    margin-bottom:10px;
}

.page-subtitle{
    color:#64748b;
    margin-bottom:30px;
    font-size:15px;
}

/* CARD */
.ia-card{
    background:white;
    padding:40px;
    border-radius:25px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    border-top:5px solid #ff6a00;
    max-width:700px;
    margin:auto;
}

/* ICON */
.ia-icon{
    width:90px;
    height:90px;
    border-radius:50%;
    background:linear-gradient(135deg,#2563eb,#1e3a8a);
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
    font-size:40px;
    margin:auto;
    margin-bottom:25px;
    box-shadow:0 10px 25px rgba(37,99,235,0.25);
}

/* TITLE */
.card-title{
    text-align:center;
    color:#1e3a8a;
    font-size:28px;
    margin-bottom:10px;
}

.card-text{
    text-align:center;
    color:#64748b;
    margin-bottom:35px;
    line-height:1.6;
}

/* INPUT GROUP */
.input-group{
    margin-bottom:25px;
}

.input-group label{
    display:block;
    margin-bottom:10px;
    color:#1e3a8a;
    font-weight:bold;
    font-size:15px;
}

/* INPUT */
.input-group input{
    width:100%;
    padding:15px;
    border:1px solid #dbeafe;
    border-radius:12px;
    outline:none;
    font-size:15px;
    background:#f8fbff;
    transition:0.3s;
}

.input-group input:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 4px rgba(37,99,235,0.1);
}

/* BUTTON */
.generate-btn{
    width:100%;
    background:linear-gradient(135deg,#ff6a00,#e65c00);
    color:white;
    border:none;
    padding:16px;
    border-radius:12px;
    cursor:pointer;
    font-size:16px;
    font-weight:bold;
    transition:0.3s;
    box-shadow:0 8px 20px rgba(255,106,0,0.25);
}

.generate-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 25px rgba(255,106,0,0.35);
}

/* INFO BOX */
.info-box{
    margin-top:30px;
    background:#f8fbff;
    border-left:5px solid #2563eb;
    padding:20px;
    border-radius:15px;
}

.info-box h4{
    color:#1e3a8a;
    margin-bottom:10px;
}

.info-box p{
    color:#475569;
    line-height:1.7;
}

/* FEATURES */
.features{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:15px;
    margin-top:25px;
}

.feature-card{
    background:white;
    padding:18px;
    border-radius:15px;
    text-align:center;
    border:1px solid #e2e8f0;
    transition:0.3s;
}

.feature-card:hover{
    transform:translateY(-3px);
    border-color:#ff6a00;
}

.feature-card h5{
    color:#1e3a8a;
    margin-top:10px;
}

.feature-card p{
    color:#64748b;
    font-size:14px;
    margin-top:5px;
}

</style>

<!-- TITLE -->
<h1 class="page-title">
     Génération IA
</h1>

<p class="page-subtitle">
    Générer automatiquement une fiche intelligente pour les produits EMS.
</p>

<!-- CARD -->
<div class="ia-card">

    <!-- ICON -->
    <div class="ia-icon">

    </div>

    <!-- TITLE -->
    <h2 class="card-title">
        Générateur de fiche produit IA
    </h2>

    <p class="card-text">
        Entrez le nom d’un produit afin de générer automatiquement
        une fiche descriptive intelligente avec les informations du stock EMS.
    </p>

    <!-- FORM -->
    <form>

        <!-- INPUT -->
        <div class="input-group">

            <label>
                 Nom du produit
            </label>

            <input type="text"
                   placeholder="Ex : Ordinateur HP, Scanner EMS, Imprimante Canon">

        </div>

        <!-- BUTTON -->
        <button type="submit"
                class="generate-btn">

             Générer fiche IA

        </button>

    </form>

    <!-- INFO -->
    <div class="info-box">

        <h4>
             Fonctionnalités IA
        </h4>

        <p>
            Le système IA peut analyser les produits,
            générer automatiquement des descriptions,
            détecter les anomalies de stock
            et proposer des recommandations intelligentes.
        </p>

    </div>

    <!-- FEATURES -->
    <div class="features">

        <div class="feature-card">

            <div style="font-size:30px;"></div>

            <h5>Analyse Stock</h5>

            <p>
                Vérification automatique des quantités.
            </p>

        </div>

        <div class="feature-card">

            <div style="font-size:30px;"></div>

            <h5>Rapidité</h5>

            <p>
                Génération instantanée des fiches produits.
            </p>

        </div>

        <div class="feature-card">

            <div style="font-size:30px;"></div>

            <h5>Sécurité</h5>

            <p>
                Gestion sécurisée des données EMS.
            </p>

        </div>

    </div>

</div>

@endsection

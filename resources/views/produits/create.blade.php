@extends('layouts.app')

@section('content')

<style>

body{
    background:#f5f7fb;
}

/* CONTAINER */
.form-container{
    width: 650px;
    margin: auto;
    background: white;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* TITLE */
.form-container h2{
    text-align:center;
    color:#1e3a8a;
    margin-bottom:25px;
    font-weight:bold;
}

/* LABEL */
.form-container label{
    font-weight:600;
    color:#1e3a8a;
    font-size:14px;
}

/* INPUTS */
.form-container input,
.form-container textarea,
.form-container select{
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 15px;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    outline: none;
    transition: 0.2s;
    background:#f9fafb;
}

/* FOCUS */
.form-container input:focus,
.form-container textarea:focus,
.form-container select:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 3px rgba(37,99,235,0.15);
    background:white;
}

/* BUTTONS */
.actions{
    margin-top:20px;
    display:flex;
    gap:12px;
}

/* SUBMIT BUTTON */
.btn-submit{
    flex:1;
    background: linear-gradient(135deg,#2563eb,#1e3a8a);
    color:white;
    padding:10px;
    border:none;
    border-radius:10px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

.btn-submit:hover{
    transform:scale(1.03);
}

/* BACK BUTTON */
.back-btn{
    flex:1;
    text-align:center;
    padding:10px;
    border-radius:10px;
    text-decoration:none;
    background:#f97316;
    color:white;
    font-weight:bold;
    transition:0.3s;
}

.back-btn:hover{
    background:#ea580c;
    transform:scale(1.03);
}

/* SMALL CARD EFFECT */
.form-container:hover{
    box-shadow:0 15px 40px rgba(0,0,0,0.12);
}

</style>

<div class="form-container">

    <h2> Ajouter Produit EMS</h2>

    <form method="POST" action="/produits/store">

        @csrf

        <label>Nom produit</label>
        <input type="text" name="nom" placeholder="Ex: Carton EMS">

        <label>Catégorie</label>
        <select name="categorie">
            <option>Emballage</option>
            <option>Étiquetage</option>
            <option>Transport</option>
            <option>Informatique</option>
            <option>Sécurité</option>
            <option>Distribution</option>
        </select>

        <label>Quantité</label>
        <input type="number" name="quantite" placeholder="Ex: 50">

        <label>Agence</label>
        <input type="text" name="agence" placeholder="Ex: Dakar Plateau">

        <div class="actions">

            <button type="submit" class="btn-submit">
                + Ajouter produit
            </button>

            <a href="/produits" class="back-btn">
                ↩ Retour
            </a>

        </div>

    </form>

</div>

@endsection

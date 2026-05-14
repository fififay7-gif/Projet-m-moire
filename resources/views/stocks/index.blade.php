@extends('layouts.app')

@section('content')

<style>

    .page-title{
        color:#1e3a8a;
        margin-bottom:25px;
    }

    .cards{
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
        gap:20px;
        margin-bottom:30px;
    }

    .card-box{
        background:white;
        padding:20px;
        border-radius:15px;
        box-shadow:0 5px 15px rgba(0,0,0,0.08);
    }

    .card-box h3{
        color:#1e3a8a;
        margin-bottom:10px;
    }

    .btn{
        display:inline-block;
        margin-top:15px;
        padding:10px 15px;
        background:#2563eb;
        color:white;
        text-decoration:none;
        border-radius:8px;
        transition:0.3s;
    }

    .btn:hover{
        background:#1e3a8a;
    }

    table{
        width:100%;
        border-collapse:collapse;
        background:white;
        border-radius:15px;
        overflow:hidden;
        box-shadow:0 5px 15px rgba(0,0,0,0.08);
    }

    table th{
        background:#1e3a8a;
        color:white;
        padding:15px;
    }

    table td{
        padding:15px;
        border-bottom:1px solid #ddd;
        text-align:center;
    }

    .stock-ok{
        color:green;
        font-weight:bold;
    }

    .stock-low{
        color:red;
        font-weight:bold;
    }

</style>

<h1 class="page-title">
    Gestion du Stock
</h1>

<!--  STATISTIQUES -->
<div class="cards">

    <div class="card-box">

        <h3> Total Produits</h3>

        <p style="font-size:30px; color:#1e3a8a;">
            42
        </p>

    </div>

    <div class="card-box">

        <h3> Produits Faibles</h3>

        <p style="font-size:30px; color:red;">
            5
        </p>

    </div>

    <div class="card-box">

        <h3> Ajouter Produit</h3>

        <p>Créer un nouveau produit</p>

        <a href="#" class="btn">
            Ajouter
        </a>

    </div>

</div>

<!--  TABLE STOCK -->
<table>

    <thead>

        <tr>

            <th>ID</th>

            <th>Produit</th>

            <th>Catégorie</th>

            <th>Quantité</th>

            <th>État</th>

            <th>Actions</th>

        </tr>

    </thead>

    <tbody>

        <tr>

            <td>1</td>

            <td>Ordinateur HP</td>

            <td>Informatique</td>

            <td>25</td>

            <td class="stock-ok">
                Disponible
            </td>

            <td>

                <a href="#" class="btn">
                    Modifier
                </a>

            </td>

        </tr>

        <tr>

            <td>2</td>

            <td>Clavier Logitech</td>

            <td>Accessoire</td>

            <td>2</td>

            <td class="stock-low">
                Stock Faible
            </td>

            <td>

                <a href="#" class="btn">
                    Modifier
                </a>

            </td>

        </tr>

        <tr>

            <td>3</td>

            <td>Souris Dell</td>

            <td>Accessoire</td>

            <td>15</td>

            <td class="stock-ok">
                Disponible
            </td>

            <td>

                <a href="#" class="btn">
                    Modifier
                </a>

            </td>

        </tr>

    </tbody>

</table>

@endsection

@extends('layouts.app')

@section('content')

<style>

body{
    background:#f5f7fb;
}

/* TOP BAR */
.top-bar {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.top-bar h2{
    color:#1e3a8a;
    font-weight:bold;
}

/* BUTTON ADD (BLEU + ORANGE ACCENT) */
.add-btn {
    background: linear-gradient(135deg,#1e3a8a,#2563eb);
    color:white;
    padding:10px 15px;
    border:none;
    border-radius:12px;
    font-weight:bold;
    transition:0.3s;
    box-shadow:0 8px 20px rgba(37,99,235,0.25);
}

.add-btn:hover{
    transform:scale(1.05);
    background: linear-gradient(135deg,#2563eb,#1e3a8a);
}

/* SUCCESS */
.success {
    background: #dcfce7;
    padding: 12px;
    margin-bottom: 15px;
    color: #166534;
    border-radius: 10px;
    border-left: 5px solid #22c55e;
}

/* STATS CARD */
.stats-card {
    background: white;
    padding: 18px;
    margin-bottom: 20px;
    border-radius: 14px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
    border-left: 6px solid #2563eb;
    position:relative;
}

/* petit accent orange */
.stats-card::after{
    content:"";
    position:absolute;
    top:0;
    right:0;
    width:80px;
    height:6px;
    background:#f97316;
    border-top-right-radius:14px;
}

.stats-number {
    font-size: 30px;
    font-weight: bold;
    color:#1e3a8a;
}

/* TABLE */
.table-container {
    background:white;
    padding:15px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,0.06);
}

.table {
    width:100%;
    border-collapse: collapse;
}

.table th, .table td {
    padding:12px;
    text-align:left;
    border-bottom:1px solid #eee;
}

.table th {
    background: linear-gradient(135deg,#1e3a8a,#2563eb);
    color:white;
}

.table tr:hover{
    background:#f0f4ff;
}

/* MODAL HEADER BLEU */
.modal-header{
    background: linear-gradient(135deg,#1e3a8a,#2563eb);
    color:white;
}

/* BUTTON ORANGE ACTION */
.btn-primary{
    background:#f97316;
    border:none;
    font-weight:bold;
    border-radius:10px;
}

.btn-primary:hover{
    background:#ea580c;
}

/* INPUT STYLE */
.form-control{
    border-radius:10px;
    padding:10px;
    border:1px solid #e5e7eb;
}

.form-control:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 3px rgba(37,99,235,0.15);
}

</style>

<!-- TOP BAR -->
<div class="top-bar">

    <h2> Gestion des Produits EMS</h2>

    <button class="add-btn" data-bs-toggle="modal" data-bs-target="#addProduitModal">
        + Ajouter Produit
    </button>

</div>

<!-- SUCCESS -->
@if(session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
@endif

<!-- STATS -->
<div class="stats-card">
    <p style="color:#64748b;">Nombre total de produits</p>
    <div class="stats-number">
        {{ $nombreProduits }}
    </div>
</div>

<!-- TABLE -->
<div class="table-container">

    <table class="table">

        <thead>
            <tr>
                <th>ID</th>
                <th>Produit</th>
                <th>Catégorie</th>
                <th>Quantité</th>
                <th>Agence</th>
            </tr>
        </thead>

        <tbody>

            @foreach($produits as $produit)

                <tr>
                    <td>{{ $produit->id }}</td>
                    <td><strong>{{ $produit->nom }}</strong></td>
                    <td>{{ $produit->categorie }}</td>
                    <td>{{ $produit->quantite }}</td>
                    <td>{{ $produit->agence }}</td>
                </tr>

            @endforeach

        </tbody>

    </table>

</div>

<!-- MODAL -->
<div class="modal fade" id="addProduitModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"> Ajouter Produit EMS</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="/produits/store">
                @csrf

                <div class="modal-body">

                    <input class="form-control mb-2" name="nom" placeholder="Nom produit">

                    <select class="form-control mb-2" name="categorie">
                        <option>Emballage</option>
                        <option>Étiquetage</option>
                        <option>Transport</option>
                        <option>Informatique</option>
                        <option>Sécurité</option>
                        <option>Distribution</option>
                    </select>

                    <input class="form-control mb-2" type="number" name="quantite" placeholder="Quantité">

                    <input class="form-control mb-2" name="agence" placeholder="Agence">

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Ajouter
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection

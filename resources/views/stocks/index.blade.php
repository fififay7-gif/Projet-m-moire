@extends('layouts.app')

@section('content')

<style>

body{
    background:#f5f7fb;
}

/* ===== TITRE ===== */
.stock-title{
    color:#1e3a8a;
    margin-bottom:20px;
    font-weight:bold;
}

/* ===== SUCCESS ===== */
.success{
    background:#dcfce7;
    color:#166534;
    padding:12px;
    border-radius:10px;
    margin-bottom:20px;
    border-left:5px solid #22c55e;
}

/* ===== TABLE ===== */
.stock-table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,0.06);
}

/* HEADER BLEU */
.stock-table th{
    background: linear-gradient(135deg,#1e3a8a,#2563eb);
    color:white;
    padding:14px;
    text-align:center;
}

/* CELLS */
.stock-table td{
    padding:12px;
    border-bottom:1px solid #eee;
    text-align:center;
}

/* HOVER ROW */
.stock-table tr:hover{
    background:#f0f4ff;
}

/* ===== ORANGE EMS BOOSTÉ ===== */
:root{
    --ems-orange:#ff6a00;
    --ems-orange-dark:#e65c00;
    --ems-orange-soft:#fff1e6;
}

/* STOCK FAIBLE (ORANGE ALERT) */
.low-stock{
    background: var(--ems-orange-soft);
    color: var(--ems-orange);
    font-weight:bold;
    padding:6px 10px;
    border-radius:8px;
    border-left:4px solid var(--ems-orange);
}

/* STOCK OK */
.ok-stock{
    background:#dcfce7;
    color:#16a34a;
    font-weight:bold;
    padding:6px 10px;
    border-radius:8px;
}

/* INPUT */
.qty-input{
    width:80px;
    padding:6px;
    border-radius:8px;
    border:1px solid #e5e7eb;
    text-align:center;
}

/* ===== BOUTON MODIFIER (BLEU) ===== */
.update-btn{
    background: linear-gradient(135deg,#2563eb,#1e3a8a);
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
    transition:0.3s;
}

.update-btn:hover{
    transform:scale(1.05);
}

/* ===== BOUTON SUPPRIMER (ORANGE BOOSTÉ) ===== */
.delete-btn{
    background: var(--ems-orange);
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
    transition:0.3s;
    box-shadow:0 4px 12px rgba(255,106,0,0.25);
}

.delete-btn:hover{
    background: var(--ems-orange-dark);
    transform:scale(1.08);
    box-shadow:0 6px 18px rgba(255,106,0,0.35);
}

</style>

<h2 class="stock-title">
     Gestion du Stock EMS
</h2>

@if(session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
@endif

<table class="stock-table">

    <thead>
        <tr>
            <th>ID</th>
            <th>Produit</th>
            <th>Catégorie</th>
            <th>Quantité</th>
            <th>Agence</th>
            <th>État</th>
            <th>Modifier</th>
            <th>Supprimer</th>
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

            <td>
                @if($produit->quantite < 10)
                    <span class="low-stock"> Stock Faible</span>
                @else
                    <span class="ok-stock"> Stock OK</span>
                @endif
            </td>

            <!-- UPDATE -->
            <td>
                <form method="POST" action="/stocks/update/{{ $produit->id }}">
                    @csrf

                    <input type="number"
                           name="quantite"
                           value="{{ $produit->quantite }}"
                           class="qty-input">

                    <button type="submit" class="update-btn">
                        Modifier
                    </button>

                </form>
            </td>

            <!-- DELETE -->
            <td>
                <form method="POST" action="/stocks/delete/{{ $produit->id }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            onclick="return confirm('Supprimer ce produit ?')"
                            class="delete-btn">
                        Supprimer
                    </button>

                </form>
            </td>

        </tr>

        @endforeach

    </tbody>

</table>

@endsection

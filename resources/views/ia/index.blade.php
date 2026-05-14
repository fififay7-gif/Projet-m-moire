@extends('layouts.app')

@section('content')

<h1 style="color:#1e3a8a;">
     Génération IA
</h1>

<div class="card">

    <form>

        <label>Nom du produit</label><br><br>

        <input type="text"
               placeholder="Ex: Ordinateur HP"
               style="width:100%; padding:10px;"><br><br>

        <button type="submit"
                style="
                background:#2563eb;
                color:white;
                border:none;
                padding:12px 20px;
                border-radius:8px;
                cursor:pointer;">

            Générer fiche IA

        </button>

    </form>

</div>

@endsection

@extends('layouts.app')

@section('content')

<div class="card">

<h2>Nouveau Versement</h2>

<form action="{{ route('versements.store') }}"
      method="POST">

@csrf

<select name="bordereau_id">

@foreach($bordereaux as $b)

<option value="{{ $b->id }}">
    {{ $b->numero_bordereau }}
</option>

@endforeach

</select>

<br><br>

<input type="number"
       name="montant"
       placeholder="Montant">

<br><br>

<input type="text"
       name="banque"
       placeholder="Banque">

<br><br>

<input type="date"
       name="date_versement">

<br><br>

<button type="submit">

Enregistrer

</button>

</form>

</div>

@endsection

@extends('layouts.app')

@section('content')

<div class="card">

<h2>Liste des Bordereaux</h2>

<a href="{{ route('bordereaux.create') }}">
    Nouveau Bordereau
</a>

<table border="1" width="100%">

<tr>
    <th>N°</th>
    <th>Montant</th>
    <th>Date</th>
</tr>

@foreach($bordereaux as $b)

<tr>

<td>{{ $b->numero_bordereau }}</td>

<td>{{ $b->montant_total }}</td>

<td>{{ $b->date_bordereau }}</td>

</tr>

@endforeach

</table>

</div>

@endsection

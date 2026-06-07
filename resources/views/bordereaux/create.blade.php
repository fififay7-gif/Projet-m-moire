@extends('layouts.app')

@section('content')

<div class="card">

    <h2>Nouveau Bordereau</h2>

    <form action="{{ route('bordereaux.store') }}" method="POST">
        @csrf

        <label>Montant total</label>

        <input type="number"
               step="0.01"
               name="montant_total"
               required>

        <br><br>

        <label>Date</label>

        <input type="date"
               name="date_bordereau"
               required>

        <br><br>

        <button type="submit">
            Enregistrer
        </button>

    </form>

</div>

@endsection

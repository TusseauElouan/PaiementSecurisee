@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Remboursement</h1>
    <form action="{{ route('paiements.refund.process', $paiement->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="montant" class="form-label">Montant à rembourser</label>
            <input
                type="number"
                id="montant"
                name="montant"
                class="form-control"
                step="0.01"
                min="0.01"
                max="{{ $montantRestant }}"
                required
            >
            <small>Montant restant remboursable : {{ number_format($montantRestant, 2) }} €</small>
        </div>
        <button type="submit" class="btn btn-primary">Rembourser</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Remboursement pour le paiement de {{ number_format($paiement->montant, 2) }} €</h1>

    <form action="{{ url('paiements/' . $paiement->id . '/refund') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="montant">Montant du remboursement</label>
            <input type="number" name="montant" id="montant" class="form-control" step="0.01" min="0.01" max="{{ $paiement->amount }}" required>
            @error('montant')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Rembourser</button>
    </form>
</div>
@endsection

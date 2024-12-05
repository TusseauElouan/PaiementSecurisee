@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un Paiement</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('paiements.store') }}">
        @csrf
        <div class="mb-3">
            <label for="card_number" class="form-label">Numéro de carte</label>
            <input type="text" name="card_number" id="card_number" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="card_expiration" class="form-label">Date d'expiration (MM/YY)</label>
            <input type="text" name="card_expiration" id="card_expiration" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="card_cvv" class="form-label">CVV</label>
            <input type="password" name="card_cvv" id="card_cvv" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Montant (€)</label>
            <input type="number" name="amount" id="amount" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Payer</button>
    </form>
</div>
@endsection

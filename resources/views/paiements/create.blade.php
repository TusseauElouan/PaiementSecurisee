@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Ajouter un Paiement</h3>
                    <p class="mb-0">Vos informations restent confidentielles et sécurisées.</p>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('paiements.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="card_number" class="form-label">
                                <i class="bi bi-credit-card"></i> Numéro de carte
                            </label>
                            <input
                                type="text"
                                name="card_number"
                                id="card_number"
                                class="form-control"
                                placeholder="1234 5678 9012 3456"
                                required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="card_expiration" class="form-label">
                                    <i class="bi bi-calendar2-check"></i> Expiration (MM/YY)
                                </label>
                                <input
                                    type="text"
                                    name="card_expiration"
                                    id="card_expiration"
                                    class="form-control"
                                    placeholder="MM/YY"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="card_cvv" class="form-label">
                                    <i class="bi bi-lock-fill"></i> CVV
                                </label>
                                <input
                                    type="password"
                                    name="card_cvv"
                                    id="card_cvv"
                                    class="form-control"
                                    placeholder="123"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">
                                <i class="bi bi-currency-euro"></i> Montant (€)
                            </label>
                            <input
                                type="number"
                                name="amount"
                                id="amount"
                                class="form-control"
                                placeholder="Entrez le montant"
                                required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-shield-lock-fill"></i> Payer Maintenant
                        </button>
                    </form>
                </div>
                <div class="card-footer text-center text-muted">
                    <small><i class="bi bi-lock-fill"></i> Paiement sécurisé par SSL</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


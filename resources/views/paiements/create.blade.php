@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100 px-4">
    <div class="w-full max-w-md p-6 bg-white border border-gray-200 rounded-lg shadow-lg">
        <h4 class="text-center text-xl font-bold text-gray-800 mb-6">Ajouter un Paiement</h4>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-300 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('paiements.store') }}">
            @csrf

            <!-- Numéro de carte -->
            <div class="mb-4">
                <label for="card_number" class="block text-sm font-medium text-gray-700">Numéro de carte</label>
                <input type="text" name="card_number" id="card_number"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="1234 5678 9012 3456" required>
            </div>

            <!-- Date d'expiration -->
            <div class="mb-4">
                <label for="card_expiration" class="block text-sm font-medium text-gray-700">Date d'expiration (MM/YY)</label>
                <input type="text" name="card_expiration" id="card_expiration"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="MM/YY" required>
            </div>

            <!-- CVV -->
            <div class="mb-4">
                <label for="card_cvv" class="block text-sm font-medium text-gray-700">CVV</label>
                <input type="password" name="card_cvv" id="card_cvv"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="123" required>
            </div>

            <!-- Montant -->
            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700">Montant (€)</label>
                <input type="number" name="amount" id="amount"
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="0.00" required>
            </div>

            <!-- Bouton -->
            <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Payer
            </button>
        </form>
    </div>
</div>
@endsection

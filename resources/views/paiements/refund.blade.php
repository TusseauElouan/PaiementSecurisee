@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-white shadow rounded-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Remboursement</h1>

    <form action="{{ route('paiements.refund.process', $paiement->uuid) }}" method="POST">
        @csrf
        <div class="mb-6">
            <label for="montant" class="block text-sm font-medium text-gray-700 mb-2">Montant à rembourser</label>
            <input
                type="number"
                id="montant"
                name="montant"
                class="block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 text-gray-900 focus:ring-blue-500 focus:border-blue-500"
                step="0.01"
                min="0.01"
                max="{{ $montantRestant }}"
                required
            >
            <p class="mt-2 text-sm text-gray-500">Montant restant remboursable : <span class="font-medium">{{ number_format($montantRestant, 2) }} €</span></p>
        </div>

        <button
            type="submit"
            class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        >
            Rembourser
        </button>
    </form>
</div>
@endsection

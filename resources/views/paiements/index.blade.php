@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Liste des Paiements</h1>
        <a href="{{ route('paiements.create') }}"
            class="inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
            Ajouter un Paiement
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg border border-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Montant</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Numéro de Carte</th>
                    @if (Bouncer::is(auth()->user())->an('admin'))
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Utilisateur</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($paiements as $paiement)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ number_format($paiement->montant, 2) }} €
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $paiement->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ substr($paiement->carte_premiers_quatre, 0, 4) }} **** **** {{ substr($paiement->carte_derniers_quatre, -4) }}
                        </td>
                        @if (Bouncer::is(auth()->user())->an('admin'))
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $paiement->user->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ url('paiements/' . $paiement->id . '/refund') }}"
                                    class="inline-block bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                    Rembourser
                                </a>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ Bouncer::is(auth()->user())->an('admin') ? 5 : 3 }}"
                            class="px-6 py-4 text-center text-sm text-gray-500">
                            Aucun paiement trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

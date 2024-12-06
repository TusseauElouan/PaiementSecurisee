@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Paiements</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Montant</th>
                <th>Date</th>
                <th>Numéro de Carte</th>
                @if(Bouncer::is(auth()->user())->an('admin'))
                    <th>Utilisateur</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($paiements as $paiement)
                <tr>
                    <td>{{ number_format($paiement->amount, 2) }} €</td>
                    <td>{{ $paiement->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ substr($paiement->carte_premiers_quatre, 0, 4) }} **** **** {{ substr($paiement->carte_derniers_quatre, -4) }}</td>
                    @if(Bouncer::is(auth()->user())->an('admin'))
                        <td>{{ $paiement->user->name }}</td>
                    @endif
                    @if(Bouncer::is(auth()->user())->an('admin'))
                        <td>
                            <a href="{{ url('paiements/' . $paiement->id . '/refund') }}" class="btn btn-warning">Rembourser</a>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ Bouncer::is(auth()->user())->an('admin') ? 4 : 3 }}" class="text-center">
                        Aucun paiement trouvé.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Remboursement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class PaiementController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Bouncer::is(auth()->user())->an('admin')) {
            $paiements = Paiement::with('user')->get();
        } else {
            $paiements = auth()->user()->paiements;
        }

        return view('paiements.index', compact('paiements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paiements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'card_number' => 'required|digits:16',
            'card_expiration' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'card_cvv' => 'required|digits:3',
            'amount' => 'required|numeric|min:0.01|max:999999999999.99',
        ]);

        try {
            $expiration = Carbon::createFromFormat('m/y', $request->card_expiration)->endOfMonth();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['card_expiration' => 'Le format de la date est invalide.']);
        }


        if ($expiration->isPast()) {
            return redirect()->back()->withErrors(['card_expiration' => 'La carte est expirée.']);
        }

        $card_number = $request->input('card_number');

        $encryptedCardNumber = Crypt::encryptString($request->card_number);
        $encryptedCVV = Crypt::encryptString($request->card_cvv);

        $paiement = new Paiement();
        $paiement->user_id = auth()->id();
        $paiement->montant = $request->input('amount');
        $paiement->carte_date_expiration = $request->input('card_expiration');
        $paiement->carte_premiers_quatre = substr($card_number, 0,4);
        $paiement->carte_derniers_quatre = substr($card_number, -4,);
        $paiement->carte_chiffree = $encryptedCardNumber;
        $paiement->transaction_id = 'txn_' . uniqid();
        $paiement->uuid = Str::uuid()->toString();
        $paiement->cvv = $encryptedCVV;
        $paiement->save();

        return redirect()->route('paiements.index')->with('message', 'Paiement ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Paiement $paiement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paiement $paiement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paiement $paiement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paiement $paiement)
    {
        //
    }

    public function refundForm($uuid)
    {
        $paiement = Paiement::where('uuid', $uuid)->firstOrFail();
        $this->authorize('refund');
        $montantRestant = $paiement->montantRestant();
        return view('paiements.refund', compact('paiement', 'montantRestant'));
    }


    public function processRefund(Request $request, $id)
    {
        $paiement = Paiement::findOrFail($id);
        $this->authorize('refund');
        $montantRestant = $paiement->montantRestant();
        $request->validate([
            'montant' => "required|numeric|min:0.01|max:$montantRestant",
        ]);

        Remboursement::create([
            'user_id' => auth()->user()->id,
            'montant' => $request->montant,
            'transaction_id' => $paiement->transaction_id,
        ]);


        return redirect()->route('paiements.index')->with('success', 'Remboursement effectué avec succès.');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paiements = Paiement::where('user_id', auth()->id())->get();

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
            'amount' => 'required|numeric|min:0.01',
        ]);

        $expiration = \Carbon\Carbon::createFromFormat('m/y', $request->card_expiration);


        if ($expiration->endOfMonth()->isPast()) {
            echo "La carte est expirée.";
        }

        $card_number = $request->input('card_number');

        $encryptedCardNumber = Crypt::encryptString($request->card_number);

        $paiement = new Paiement();
        $paiement->user_id = auth()->id();
        $paiement->montant = $request->input('amount');
        $paiement->carte_date_expiration = $request->input('card_expiration');
        $paiement->carte_premiers_quatre = substr($card_number, 0,4);
        $paiement->carte_derniers_quatre = substr($card_number, -4,);
        $paiement->carte_chiffree = $encryptedCardNumber;
        $paiement->transaction_id = 'txn_' . uniqid();
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

}

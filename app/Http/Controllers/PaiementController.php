<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;

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
        return view('paiements.store');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'card_number' => 'required|digits:16',
            'card_expiration' => 'required|date_format:m/y',
            'card_cvv' => 'required|digits:3',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $card_number = $request->input('card_number');

        Paiement::create([
            'user_id' => auth()->id(),
            'montant' => $request->input('amount'),
            'carte_premiers_quatre' => substr($card_number, 0, 4),
            'carte_derniers_quatre' => substr($card_number, -4),
            'carte_date_expiration' => '20' . substr($request->input('card_expiration'), -2) . '-' . substr($request->input('card_expiration'), 0, 2) . '-01',
            'transaction_id' => 'txn_' . uniqid(),
        ]);

        return redirect()->route('paiements.index')->with('message', 'Paiement ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Paiement $paiement)
    {
        $paiement = Paiement::where('user_id', auth()->id())->findOrFail($id);

        return view('paiements.show', compact('paiement'));
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

    public function showForm()
    {
        return view('paiements.create');
    }

}

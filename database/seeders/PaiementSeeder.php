<?php

namespace Database\Seeders;

use App\Models\Paiement;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaiementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        Paiement::create([
            'user_id' => $user->id,
            'montant' => 150.75,
            'carte_premiers_quatre' => '1234',
            'carte_derniers_quatre' => '5678',
            'carte_date_expiration' => '2026-05-01',
            'transaction_id' => 'txn_'.uniqid(),
        ]);
    }
}

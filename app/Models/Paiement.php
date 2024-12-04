<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'montant',
        'carte_premiers_quatre',
        'carte_derniers_quatre',
        'carte_date_expiration',
        'transaction_id',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
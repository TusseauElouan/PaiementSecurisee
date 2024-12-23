<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function remboursements()
{
    return $this->hasMany(Remboursement::class, 'transaction_id', 'transaction_id');
}

    public function montantRestant()
    {
        $remboursementsTotal = $this->remboursements->sum('montant');
        return $this->montant - $remboursementsTotal;
    }

    public function montantRemboursee()
    {
        return $this->remboursements->sum('montant');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($paiement) {
            $paiement->uuid = Str::uuid()->toString(); // Utilisation de UUID
        });
    }
}

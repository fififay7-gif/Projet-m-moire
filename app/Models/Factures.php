<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factures extends Model
{
    protected $fillable = [
        'client_id',
        'montant',
        'montant_paye',
        'reste',
        'statut',
        'created_by'
    ];

    // RELATION CLIENT
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // RELATION PAIEMENTS
    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    // TOTAL PAYE
    public function getTotalPayeAttribute()
    {
        return $this->paiements->sum('montant_paye');
    }

    // STATUT FACTURE
    public function getStatutAutoAttribute()
    {
        if ($this->total_paye >= $this->montant) {
            return 'payée';
        }

        if ($this->total_paye > 0) {
            return 'partielle';
        }

        return 'impayée';
    }
}

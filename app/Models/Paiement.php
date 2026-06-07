<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'facture_id',
        'montant_paye',
        'date_paiement',
        'mode_paiement'
    ];

   public function client()
{
    return $this->belongsTo(Client::class);
}
}

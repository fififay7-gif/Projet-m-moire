<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paiement extends Model
{
    //  Ajoute bien 'mode_paiement' dans cette liste
    protected $fillable = [
        'client_id',
        'reservation_id',
        'montant',
        'mode_paiement',
        'date_paiement',
    ];

    public function client(): BelongsTo
    {
        //  Permet de récupérer le client associé à ce paiement
        return $this->belongsTo(Client::class, 'client_id');
    }
}

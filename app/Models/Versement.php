<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Importation requise

class Versement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'paiement_id',
        'user_id',
        'reference_versement',
        'montant',
        'banque',
        'date_versement'
    ];

    /**
     * Un versement appartient à un paiement.
     */
    public function paiement(): BelongsTo
    {
        return $this->belongsTo(Paiement::class, 'paiement_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bordereau extends Model
{
    protected $table = 'bordereaux';

    // Si tes bordereaux sont liés à un client ou à un paiement, assure-toi d'avoir ceci :
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function versements(): HasMany
    {
        return $this->hasMany(Versement::class, 'bordereau_id');
    }
}

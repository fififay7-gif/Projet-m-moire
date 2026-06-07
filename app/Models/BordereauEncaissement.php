<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BordereauEncaissement extends Model
{
    protected $table = 'bordereaux_encaissement';

    protected $fillable = [
        'user_id',
        'numero_bordereau',
        'montant_total',
        'date_bordereau'
    ];
}

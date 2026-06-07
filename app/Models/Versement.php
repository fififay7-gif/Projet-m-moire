<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Versement extends Model
{
    protected $fillable = [
        'bordereau_id',
        'montant',
        'banque',
        'date_versement'
    ];
}

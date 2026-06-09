<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Versement extends Model
{
    protected $fillable = ['reference_versement', 'montant', 'banque', 'date_versement', 'user_id', 'bordereau_id', 'preuve_achat'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function bordereau() {
        return $this->belongsTo(Bordereau::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'nom',
        'quantite',
        'categorie',
        'agence',

    ];

    public function mouvements()
    {
        return $this->hasMany(Mouvement::class);
    }

    public function alertes()
    {
        return $this->hasMany(AlerteStock::class);
    }

    public function fichesIA()
    {
        return $this->hasMany(FicheIA::class);
    }
}

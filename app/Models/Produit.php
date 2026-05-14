<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    // C'est ici que vous définissez les champs autorisés (fillable)
    protected $fillable = ['nom', 'description', 'quantite', 'prix', 'seuil_alerte'];

    // Vos relations éventuelles
}

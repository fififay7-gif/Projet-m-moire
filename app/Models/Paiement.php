<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    // On autorise Laravel à insérer le client et le montant
   protected $fillable = ['client_id', 'montant', 'date_paiement'];
    // Cette relation permet d'afficher le nom du client dans ton tableau HTML
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
  protected $fillable = [
    'code', 'client_id', 'destination', 'classe', 'type_service',
    'description', 'statut', 'motif_rejet', 'date_reservation',
    'montant', 'mode_paiement'
];
    public function client()
    {
        return $this->belongsTo(Client::class);

       }

       public function scopeValide($query) {
    return $query->where('statut', 'validee');
}
// Utilisation : Reservation::valide()->sum('montant');
}

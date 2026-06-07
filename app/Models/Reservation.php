<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
    'client_id',
    'type_voyage',

    'date_reservation'
];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

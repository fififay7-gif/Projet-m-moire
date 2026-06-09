<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bordereau extends Model
{
    // Si tu as utilisé le pluriel pour ta table dans la migration :
    protected $table = 'bordereaux';

    protected $fillable = ['code_bordereau', 'date_creation', 'statut', 'user_id', 'observations'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function versements() {
        return $this->hasMany(Versement::class);
    }
}

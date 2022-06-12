<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculeDisponibleTrajet extends Model
{
    use HasFactory;
    protected $table = "vehicule_disponnible_trajet";
    public $timestamps = false;

    public function vehicule(){
        return $this->hasOne(Vehicule::class, 'id', 'id');
    }
}

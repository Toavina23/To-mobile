<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type extends Model
{
    use HasFactory;
    // protected $fillable = ['produit', 'quantite', 'montant'];
    public $timestamps = false;

    public function vehicules(){
        return $this->belongsToMany(Vehicule::class);
    }
}

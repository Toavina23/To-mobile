<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    use HasFactory;
    protected $fillable = ['chauffeur_id','motif', 'date_depart', 'kilometrage_depart', 'montant_carburant', 'kilometrage_arrive', 'date_arrive', 'vehicule_id', 'lieu_arrive', 'lieu_depart'];
    public $timestamps = false;

    public function vehicule(){
        return $this->belongsTo(Vehicule::class);
    }

    public function lieuArrive(){
        return $this->hasOne(Lieu::class, 'id','lieu_arrive');
    }

    public function lieuDepart(){
        return $this->hasOne(Lieu::class, 'id','lieu_depart');
    }

    public function chauffeur(){
        return $this->hasOne(User::class, 'id','chauffeur_id');
    }
}

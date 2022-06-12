<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;
    protected $fillable = ['numero', 'marque', 'type_id', 'modele'];
    public $timestamps = false;

    public function type(){
        return $this->belongsTo(type::class);
    }

    public function trajets(){
        return $this->hasMany(Trajet::class);
    }
}

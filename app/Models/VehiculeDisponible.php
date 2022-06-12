<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculeDisponible extends Model
{
    use HasFactory;
    protected $table = 'vehicule_disponibles_general';
    // protected $table = 'vehicule_dispo';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Echeance extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['montant', 'debut_validite', 'fin_validite', 'vehicule_id', 'type_echeance_id'];

}

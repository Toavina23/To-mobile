<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEcheance extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['echeance_nom'];

}

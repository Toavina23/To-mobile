<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTrajet extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'total_parcourue_jour';
}

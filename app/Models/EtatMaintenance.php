<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtatMaintenance extends Model
{
    use HasFactory;
    protected $table = "detail_usure_proche";

    public function type(){
        return $this->hasOne(type::class, 'id', 'type_id');
    }
}

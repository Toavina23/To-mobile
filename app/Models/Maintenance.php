<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['type_maintenance_id', 'vehicule_id', 'maintenance_date'];
    
    public function vehicule(){
        return $this->belongsTo(Vehicule::class);
    }
    public function typeMaintenance(){
        return $this->hasOne(TypeMaintenance::class);
    }
}

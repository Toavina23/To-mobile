<?php
namespace App\Services;

use App\Models\DataTrajet;
use App\Models\Vehicule;
use App\Models\VehiculeDisponible;
use App\Models\VehiculeDisponibleTrajet;

class VehiculeService{
    public function getAllVehicules(){
        return Vehicule::all();
    }

    public function paginateVehicule(){
        return Vehicule::paginate(5);
    }

    public function getAllVehiculeDisponibles(){
        return VehiculeDisponible::paginate(5);
    }

    public function getVehicule($id){
        return Vehicule::findOrFail($id);
    }

    public function getVehiculesDispoTrajet(){
        return VehiculeDisponibleTrajet::all(); 
    }

    public function dataTrajetParJour($id){
        return DataTrajet::where('vehicule_id', $id)->get();
    }

}
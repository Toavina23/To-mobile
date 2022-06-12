<?php

namespace App\Services;

use App\Models\Trajet;
use App\Models\DernierTrajet;

class TrajetService
{
    public function getTrajetsChauffeur($chauffeur_id)
    {
        return Trajet::where('chauffeur_id', $chauffeur_id)->orderByDesc('date_depart')->paginate(5);
    }

    public function getTrajet($trajet_id)
    {
        return Trajet::findOrFail($trajet_id);
    }

    public function calculVitesseMoyenne($trajet, $kilometrageArr, $dateArr){
        $dateDiffInHours = abs(strtotime($dateArr) - strtotime($trajet->date_depart)) / (60*60);
        $distanceParcourue = $kilometrageArr - $trajet->kilometrage_depart;
        $vitesseMoyenne = $distanceParcourue / $dateDiffInHours;
        return $vitesseMoyenne;
    }

    public function getTrajetVehicule($idVehicule) {
        return Trajet::where('vehicule_id', $idVehicule)->get();
    }

    public function getDernierTrajetVehicule($idVehicule){
        return DernierTrajet::where('vehicule_id', $idVehicule)->first();
    }

}

<?php

namespace App\Services\Api;

use App\Models\Trajet;

class ApiTrajetService
{
    public function getTrajetsChauffeur($chauffeur_id)
    {
        return Trajet::where('chauffeur_id', $chauffeur_id)
                ->with('vehicule.type', 'lieuArrive', 'lieuDepart')
                ->get();
    }
}

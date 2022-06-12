<?php

namespace App\Http\Controllers;

use App\Models\Echeance;
use App\Models\EcheanceVehicule;
use App\Models\TypeEcheance;
use Illuminate\Http\Request;
use App\Services\VehiculeService;

class EcheanceController extends Controller
{
    private $vehiculeService;
    public function __construct(VehiculeService $vehiculeService)
    {
        $this->vehiculeService = $vehiculeService;
    }

    public function create(){
        $vehicules = $this->vehiculeService->getAllVehicules();
        $typeEcheances = TypeEcheance::all();
        return view('pages.commun.ajout_echeance_vehicule' , [
            'vehicules' => $vehicules,
            'typeEcheances' => $typeEcheances
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'montant' => ['required', 'numeric'],
            'debutValidite' => ['required', 'date'],
            'finValidite' => ['required', 'date'],
            'vehicule' => 'required',
            'echeance' => 'required'
        ]);
        Echeance::create([
            'montant' => $request->montant,
            'debut_validite' => $request->debutValidite,
            'fin_validite' => $request->finValidite,
            'vehicule_id' => $request->vehicule,
            'type_echeance_id' => $request->echeance
        ]);
        return $this->create();
    }

    public function etat(){
        $etatEcheances = EcheanceVehicule::all();
        return view('pages.commun.etat_echeance', [
            'etatEcheances' => $etatEcheances
        ]);
    }

}
<?php

namespace App\Http\Controllers;

use App\Models\TypeEcheance;
use Illuminate\Http\Request;
use App\Services\VehiculeService;

class TypeEcheanceController extends Controller
{

    public function index(){
        
    }

    public function create(){
        // $vehicules = $this->vehiculeService->getAllVehicules();
        return view('pages.commun.ajout_echeance');
    }

    public function store(Request $request){
        $request->validate([
            'echeance' => 'required',
        ]);
        TypeEcheance::create([
            'echeance_nom' => $request->echeance
        ]);
        return $this->create();
    }
}

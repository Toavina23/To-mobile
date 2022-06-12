<?php

namespace App\Http\Controllers;

use App\Models\EtatMaintenance;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Models\TypeMaintenance;
use App\Services\VehiculeService;

class MaintenanceController extends Controller
{
    private $vehiculeService; 
    public function __construct(VehiculeService $vehiculeService)
    {
        $this->vehiculeService = $vehiculeService;
    }

    public function create(){
        $typeMaintentances = TypeMaintenance::all();
        $vehicules = $this->vehiculeService->getAllVehicules();
        return view('pages.commun.ajout_maintenance', [
            'typeMaintenances' => $typeMaintentances,
            'vehicules' => $vehicules
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'maintenance' => ['required'],
            'vehicule' => ['required'],
            'dateMaintenance' => ['required', 'date']
        ]);
        Maintenance::create([
            'type_maintenance_id' => $request->maintenance,
            'vehicule_id' => $request->vehicule,
            'maintenance_date' => $request->dateMaintenance
        ]);
        return $this->create();
    }

    public function index(){
        $etatMaintenances = EtatMaintenance::paginate(5);
        return view('pages.commun.etat_maintenance', ['etatMaintenances' => $etatMaintenances]);
    }
}

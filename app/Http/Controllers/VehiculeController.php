<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Services\TrajetService;
use Illuminate\Http\Request;
use App\Services\TypeService;
use App\Services\VehiculeService;
use PDF;

class VehiculeController extends Controller
{
    private $typeService;
    private $vehiculeService;
    private $trajetService;
    public function __construct(TypeService $typeService, VehiculeService $vehiculeService, TrajetService $trajetService)
    {
        $this->typeService = $typeService;
        $this->vehiculeService = $vehiculeService;
        $this->trajetService = $trajetService;
    }

    public function index(){
        $vehicules = $this->vehiculeService->paginateVehicule();
        return view('pages.admin.vehicules', [
            'vehicules' => $vehicules
        ]);
    }

    public function create(){
        $types = $this->typeService->getAllTypes();
        return view('pages.admin.admin_home',[
            'types' => $types
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'numero' => ['required','unique:vehicules,numero'],
            'modele' => 'required',
            'type' => 'required',
            'marque' => 'required'
        ]);
        Vehicule::create([
            'numero' => $request->numero,
            'modele' => $request->modele,
            'marque' => $request->marque,
            'type_id' => $request->type,
        ]);
        return $this->index();
    }

    public function vehiculeDisponibles(){
        $vehicules = $this->vehiculeService->getAllVehiculeDisponibles();
        return view('pages.commun.disponibilite_vehicule', [
            'vehicules' => $vehicules
        ]);
    }

    public function pdfTrajetVehicule($id){
        $vehicule = $this->vehiculeService->getVehicule($id);
        $trajets = $this->trajetService->getTrajetVehicule($id);
        $pdf = PDF::loadView('pdfs.trajets_vehicule', [
            'vehicule' => $vehicule,
            'trajets' => $trajets
        ]);
        return $pdf->download('trajets_'.$vehicule->numero.'.pdf');
    }

    public function grapheTrajet($id){

        $data = $this->vehiculeService->dataTrajetParJour($id);
        $km = [0];
        $date = ['origine'];
        $vehicule = $this->vehiculeService->getVehicule($id);
        foreach($data as $d){
            $km[] = $d->total;
            $date[] = $d->date_depart;
        }
        return view('pages.admin.vehicule-chart', [
            'km' => $km,
            'date' => $date,
            'vehicule' => $vehicule
        ]);
    }
}

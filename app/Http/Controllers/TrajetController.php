<?php

namespace App\Http\Controllers;

use App\Models\Lieu;
use App\Models\Trajet;
use App\Models\VehiculeDisponibleTrajet;
use App\Rules\DateDepartTrajet;
use App\Rules\DisponnibleTrajet;
use App\Rules\Equals;
use App\Rules\EqualsKilometrage;
use App\Rules\EqualsLieu;
use Illuminate\Http\Request;
use App\Services\TrajetService;
use App\Services\VehiculeService;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class TrajetController extends Controller
{
    private $vehiculeService;
    public $trajetService;
    public function __construct(VehiculeService $vehiculeService, TrajetService $trajetService)
    {
        $this->vehiculeService = $vehiculeService;
        $this->trajetService = $trajetService;
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $trajet = $this->trajetService->getTrajet($id);
        if ($request->input('dateArrive') != null && $request->input('kilometrageArr') != null) {
            $request->validate([
                'dateArrive' => ['required', 'after:' . $trajet->date_depart],
                'kilometrageArr' => ['gt:' . $trajet->kilometrage_depart],
                'lieuArrive' => ['required']
            ]);
            $vitesseMoyenne = $this->trajetService->calculVitesseMoyenne($trajet, $request->input('kilometrageArr'), $request->input('dateArrive'));
            if ($vitesseMoyenne >= 72) {
                return $this->show($id, 'error');
            }
            $trajet->lieu_arrive = $request->lieuArrive;
            $trajet->date_arrive = $request->input('dateArrive');
            $trajet->kilometrage_arrive = $request->input('kilometrageArr');
        }
        if ($request->input('montantCarburantSup') != null && $request->input('quantiteCarburantSup') != null) {
            $request->validate([
                'montantCarburant' => ['gt:0'],
                'quantiteCarburant' => ['gt:0']
            ]);
            $montant_initial = $request->input('montantCarburant');
            $quantite_initial = $request->input('quantiteCarburant');
            $trajet->montant_carburant = $montant_initial + $request->input('montantCarburantSup');
            $trajet->quantite_carburant = $quantite_initial + $request->input('quantiteCarburantSup');
        }
        $trajet->save();
        return $this->show($id);
    }

    public function show($id, $validationError = null)
    {
        $trajet = $this->trajetService->getTrajet($id);
        $lieus = Lieu::all();
        $data = array(
            'trajet' => $trajet,
            'lieus' => $lieus
        );
        if ($validationError) {
            $data['kilometrageError'] = "Can't have an average speed greater than 72 km/h";
        }
        return view('pages.trajet', $data);
    }

    public function index()
    {
        $trajets = $this->trajetService->getTrajetsChauffeur(Auth::user()->id);
        $data = array(
            'trajets' => $trajets
        );
        return view('pages.home', $data);
    }

    public function create()
    {
        $vehicules = $this->vehiculeService->getAllVehicules();
        $lieus = Lieu::all();
        $data = array(
            'vehicules' => $vehicules,
            'lieus' => $lieus
        );
        return view('pages.trajets', $data);
    }

    public function store(Request $request)
    {
        $dernierTrajet = $this->trajetService->getDernierTrajetVehicule($request->vehicule);
        $request->validate([
            'motif' => 'required',
            'dateDepart' => ['required', 'date', new DateDepartTrajet($dernierTrajet)],
            'kilometrageDep' => ['required', 'numeric', new EqualsKilometrage($dernierTrajet)],
            'vehicule' => ['required', new DisponnibleTrajet($this->vehiculeService->getVehiculesDispoTrajet())],
            'lieuDepart' => ['required', new EqualsLieu($dernierTrajet)]
        ]);
        $montant_carburant = 0;
        if (!$request->montantCarburant != null) {
            $montant_carburant = $request->montantCarburant;
        }
        $quantite_carburant = 0;
        if (!$request->quantiteCarburant != null) {
            $quantite_carburant = $request->quantiteCarburant;
        }
        Trajet::create([
            'date_depart' => $request->dateDepart,
            'kilometrage_depart' => $request->kilometrageDep,
            'motif' => $request->motif,
            'vehicule_id' => $request->vehicule,
            'montant_carburant' => $montant_carburant,
            'quantite_carburant' => $quantite_carburant,
            'chauffeur_id' => Auth::user()->id,
            'lieu_depart' => $request->lieuDepart
        ]);

        return $this->index();
    }
}

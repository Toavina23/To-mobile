<?php

namespace App\Http\Controllers\Api;

use App\Models\Lieu;
use Illuminate\Http\Request;
use App\Services\VehiculeService;
use App\Http\Controllers\Controller;

class VehiculeController extends Controller
{
    private $vehiculeService;

    public function __construct(VehiculeService $vehiculeService)
    {
        $this->vehiculeService = $vehiculeService;
    }

    public function index()
    {
        return response()->json(["vehicules" => $this->vehiculeService->getAllVehicules()]);
    }
}

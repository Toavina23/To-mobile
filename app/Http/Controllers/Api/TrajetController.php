<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\TrajetService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Api\ApiTrajetService;

class TrajetController extends Controller
{
    private $trajetService;
    public function __construct(ApiTrajetService $trajetService){
        $this->trajetService = $trajetService;
    }

    public function index(Request $request){
        $trajets = $this->trajetService->getTrajetsChauffeur($request->user()->id);
        return response()->json(['trajets' =>$trajets]);
    }
}

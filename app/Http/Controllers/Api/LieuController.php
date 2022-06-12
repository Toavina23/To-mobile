<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lieu;
use Illuminate\Http\Request;

class LieuController extends Controller{
    function index(){
        return response()->json(['lieux' => Lieu::all()]);
    }
}
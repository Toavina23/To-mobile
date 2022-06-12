<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index()
    {
        $commands = Commande::paginate(5);
        return view('pages.commandes', ["commands"=>$commands]);
    }
}

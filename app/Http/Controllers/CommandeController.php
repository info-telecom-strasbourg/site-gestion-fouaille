<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller{
    public function index(){
        return view('commandes.index', [
            'commandes' => Commande::latest('date')
                ->get()
        ]);
    }
}

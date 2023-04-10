<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

use Carbon\Carbon;

class CommandeController extends Controller{
    public function index(){
        $commandes = Commande::latest('date')->paginate(50)->withQueryString();
        Carbon::setLocale('fr');

        foreach ($commandes as $commande){
            $commande->date = Carbon::createFromFormat('Y-m-d H:i:s', $commande->date);
        }

        return view('commandes.index', [
            'commandes' => $commandes,
        ]);
    }
}

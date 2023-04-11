<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

use Carbon\Carbon;

class CommandeController extends Controller{
    public function index(){
        $commandes = Commande::latest('date')
            ->paginate(50)
            ->withQueryString();

        Carbon::setLocale('fr');

        foreach ($commandes as $commande){
            if (request()->has('displayForHumans') && request('displayForHumans') == 0){
                $commande->date = Carbon::createFromFormat('Y-m-d H:i:s', $commande->date)->format('d/m/Y H:i:s');
            } else {
                $commande->date = Carbon::createFromFormat('Y-m-d H:i:s', $commande->date)->diffForHumans();
            }
        }

        return view('commandes.index', [
            'commandes' => $commandes,
        ]);
    }
}

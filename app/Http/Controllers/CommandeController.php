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
            if (request()->has('displayForHumans') && request('displayForHumans') == 'true'){
                $commande->date = Carbon::createFromFormat('Y-m-d H:i:s', $commande->date)->diffForHumans();
            } else {
                $commande->date = Carbon::createFromFormat('Y-m-d H:i:s', $commande->date)->format('d/m/Y H:i:s');
            }
        }

        return view('commandes.index', [
            'commandes' => $commandes,
        ]);
    }
}

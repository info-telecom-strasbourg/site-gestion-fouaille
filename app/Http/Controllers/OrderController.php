<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use Carbon\Carbon;

class OrderController extends Controller{
    public function index(){
        $commandes = Order::latest('date')
            ->paginate(50)
            ->withQueryString();

        Carbon::setLocale('fr');

        foreach ($commandes as $commande){
            $commande->date = [
                'diffForHumans' => Carbon::createFromFormat('Y-m-d H:i:s', $commande->date)->diffForHumans(),
                'original' => Carbon::createFromFormat('Y-m-d H:i:s', $commande->date)->format('d/m/Y H:i:s'),
            ];
        }

        return view('orders.index', [
            'orders' => $commandes,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Commande;

class ApiFouailleController extends Controller
{
    public function show($id){
        return response()->json(['commandes' => Commande::all()->where('id_member', '=', $id)->map(function ($commande) {
            return [
                'date' => $commande->date,
                'total_price' => $commande->product->price,
                'amount' => $commande->amount,
                'product' => [
                    'name' => $commande->product->name,
                    'slug' => $commande->product->slug,
                    'unit_price' => $commande->product->price/$commande->amount,
                    'color' => $commande->product->color
                ]
            ];
        })->values()])->setEncodingOptions(JSON_PRETTY_PRINT);
    }
}

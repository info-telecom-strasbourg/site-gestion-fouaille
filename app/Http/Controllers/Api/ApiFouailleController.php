<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Member;

class ApiFouailleController extends Controller
{
    /*
     * Show all commands of a member
     * @param $id : id of the member
     * @return json : all commands of the member ordered by date
     */
    public function showCommand($id){
        return response()
            ->json(['commandes' => Commande::where('id_member', '=', $id)->orderBy('date')->get()->map(function ($commande) {
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
        })->values()])
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    /*
     * Show the balance of a member
     * @param $id : id of the member
     * @return json : balance of the member
     */
    public function showBalance($id){
        return response()
            ->json(['balance' => Member::find($id)->balance])
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Member;
use Illuminate\Http\Request;

class ApiFouailleController extends Controller
{
    /*
     * Show all commands of a member
     * @param $id : id of the member
     * @return json : all commands of the member ordered by date and metadata for pagination
     */
    public function showCommand($id, Request $request){
        $page_size = $request->query('page_size'); // Get the page size from the query parameters (default value is 10)
        if ($page_size == null){
            $page_size = 10;
        }

        $commandes = Commande::where('id_member', '=', $id)->orderByDesc('date')->paginate($page_size); // Get all commands of the member ordered by date and paginate them

        return response()
            ->json(['data' => $commandes->map(function ($commande) { // Format the data
                if ($commande->product != null){
                    return [
                        'date' => $commande->date,
                        'total_price' => floatval($commande->price),
                        'amount' => $commande->amount,
                        'product' => [
                            'name' => $commande->product->name,
                            'slug' => $commande->product->slug,
                            'unit_price' => floatval($commande->price)/$commande->amount,
                            'color' => $commande->product->color
                        ]
                    ];
                }else{
                    return [
                        'date' => $commande->date,
                        'total_price' => floatval($commande->price),
                        'amount' => $commande->amount,
                        'product' => null
                    ];
                }
        })->values(),
            'meta' => [ // Metadata for pagination
                'total' => $commandes->total(),
                'per_page' => $commandes->perPage(),
                'current_page' => $commandes->currentPage(),
                'last_page' => $commandes->lastPage(),
                'first_page_url' => $commandes->url(1),
                'last_page_url' => $commandes->url($commandes->lastPage()),
                'next_page_url' => $commandes->nextPageUrl(),
                'prev_page_url' => $commandes->previousPageUrl(),
                'path' => $commandes->path(),
                'from' => $commandes->firstItem(),
                'to' => $commandes->lastItem(),
                ]
            ])
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


    public function show($id, Request $request){
        $page_size = $request->query('page_size'); // Get the page size from the query parameters (default value is 10)

        if ($page_size == null){
            $page_size = 10;
        }

        $commandes = Commande::where('id_member', '=', $id)->orderByDesc('date')->paginate($page_size); // Get all commands of the member ordered by date and paginate them

        return response()
            ->json(['data' => [
                "balance" => Member::find($id)->balance,
                "commands" => $commandes->map(function ($commande) { // Format the data
                if ($commande->product != null){
                    return [
                        'date' => $commande->date,
                        'total_price' => floatval($commande->price),
                        'amount' => $commande->amount,
                        'product' => [
                            'name' => $commande->product->name,
                            'slug' => $commande->product->slug,
                            'unit_price' => floatval($commande->price)/$commande->amount,
                            'color' => $commande->product->color
                        ]
                    ];
                }else{
                    return [
                        'date' => $commande->date,
                        'total_price' => floatval($commande->price),
                        'amount' => $commande->amount,
                        'product' => null
                    ];
                }
            })->values(),
                'meta' => [ // Metadata for pagination
                    'total' => $commandes->total(),
                    'per_page' => $commandes->perPage(),
                    'current_page' => $commandes->currentPage(),
                    'last_page' => $commandes->lastPage(),
                    'first_page_url' => $commandes->url(1),
                    'last_page_url' => $commandes->url($commandes->lastPage()),
                    'next_page_url' => $commandes->nextPageUrl(),
                    'prev_page_url' => $commandes->previousPageUrl(),
                    'path' => $commandes->path(),
                    'from' => $commandes->firstItem(),
                    'to' => $commandes->lastItem(),
                ]
            ]
            ])
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }
}

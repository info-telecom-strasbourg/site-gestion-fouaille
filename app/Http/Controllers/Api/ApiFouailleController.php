<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Member;
use Illuminate\Http\Request;

class ApiFouailleController extends Controller
{
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

        $member = Member::find($id);

        if ($page_size == null){
            $page_size = 10;
        }

        $orders = Order::where('id_member', '=', $id)->orderByDesc('date')->paginate($page_size); // Get all commands of the member ordered by date and paginate them

        return response()
            ->json(['data' => [
                "balance" => $member->balance,
                "first_name" => $member->first_name,
                "last_name" => $member->last_name,
                "nickname" => $member->nickname,
                "orders" => $orders->map(function ($order) { // Format the data
                if ($order->product != null){
                    return [
                        'date' => $order->date,
                        'total_price' => $order->price,
                        'amount' => $order->amount,
                        'product' => [
                            'name' => $order->product->name,
                            'title' => $order->product->slug,
                            'unit_price' => strval(floatval($order->price)/$order->amount),
                            'color' => $order->product->color
                        ]
                    ];
                }else{
                    return [
                        'date' => $order->date,
                        'total_price' => $order->price,
                        'amount' => $order->amount,
                        'product' => null
                    ];
                }
            })->values(),
                'meta' => [ // Metadata for pagination
                    'total' => $orders->total(),
                    'per_page' => $orders->perPage(),
                    'current_page' => $orders->currentPage(),
                    'last_page' => $orders->lastPage(),
                    'first_page_url' => $orders->url(1),
                    'last_page_url' => $orders->url($orders->lastPage()),
                    'next_page_url' => $orders->nextPageUrl(),
                    'prev_page_url' => $orders->previousPageUrl(),
                    'path' => $orders->path(),
                    'from' => $orders->firstItem(),
                    'to' => $orders->lastItem(),
                ]
            ]
            ])
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }
}

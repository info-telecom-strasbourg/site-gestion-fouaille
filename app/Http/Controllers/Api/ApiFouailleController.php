<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Member;
use Illuminate\Http\Request;

class ApiFouailleController extends Controller
{
    public function show($id, Request $request){
        $per_page = $request->query('per_page'); // Get the page size from the query parameters (default value is 10)

        $member = Member::find($id);

        if ($per_page == null){
            $per_page = 10;
        }

        $orders = Order::where('member_id', '=', $id)->orderByDesc('date')->paginate($per_page); // Get all commands of the member ordered by date and paginate them

        return response()
            ->json(['data' => [
                "balance" => $member->balance,
                "first_name" => $member->first_name,
                "last_name" => $member->last_name,
                "nickname" => $member->nickname,
                "orders" => $orders->map(function ($order) { // Format the data
                return [
                    'date' => $order->date,
                    'total_price' => $order->price,
                    'amount' => $order->amount,
                    'product' => ($order->product == null) ? null : [
                        'name' => $order->product->name,
                        'title' => $order->product->slug,
                        'unit_price' => strval(floatval($order->price)/$order->amount),
                        'color' => $order->product->color
                    ]
                ];
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

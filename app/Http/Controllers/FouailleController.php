<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class FouailleController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('date', 'desc')->paginate(30);

        if($orders->isEmpty()) {
            return view('fouaille.index', [
                'data' => [],
                'pagination' => []
            ]);
        }


        return view('fouaille.index', [
            'data' => $orders->map(function ($order) {
                return [
                    'id' => $order->id,
                    'member' => [
                        'name' => $order->member->last_name . ' ' . $order->member->first_name,
                        'id' => $order->member->id
                    ],
                    'price' => $order->product == null ? '<p class="text-success">+ ' . $order->price . '€</p>' : '<p class="text-danger">' . $order->price . '€</p>',
                    'amount' => $order->amount,
                    'product' => $order->product == null ? 'rechargement' : $order->product->name,
                    'type' => $order->product == null ? 'rechargement' : $order->product->productType->type,
                    'date' => $order->date,
                ];
            }),
            'pagination' => $orders->links()
        ]);
    }
}

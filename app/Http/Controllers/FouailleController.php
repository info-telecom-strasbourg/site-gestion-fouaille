<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FouailleController extends Controller
{
    public function index()
    {

        request()->validate([
            'start_at' => 'date',
            'end_at' => 'date|after:start_at',
            'order_by' => 'string|in:date,price,amount,product,type,name',
            'order_direction' => 'string|in:asc,desc',
            'search' => 'string'
        ]);

        if(isset(request()->start_at) && isset(request()->end_at)) {
            $start_at = request()->start_at;
            $end_at = request()->end_at;
        } else {
            $start_at = Carbon::now()
                ->subDays(1)
                ->setHour(17)
                ->setMinute(30)->format('Y-m-d H:i');

            $end_at = Carbon::now()
                ->subDays(1)
                ->setHour(23)
                ->setMinute(30)->format('Y-m-d H:i');

            request()->merge([
                'start_at' => $start_at,
                'end_at' => $end_at
            ]);
        }

        if(isset(request()->order_by)) {
            $order_by = request()->order_by;
        } else {
            $order_by = 'date';
            request()->merge([
                'order_by' => 'date'
            ]);
        }

        if(isset(request()->order_direction)) {
            $order_direction = request()->order_direction;
        } else {
            $order_direction = 'desc';
            request()->merge([
                'order_direction' => 'desc'
            ]);
        }

        $orders_paginate = Order::whereBetween('date', [$start_at, $end_at])
            ->join('members', 'orders.member_id', '=', 'members.id')
            ->order($order_by, $order_direction)
            ->filter(request(['search']))
            ->paginate(25)->withQueryString();


        if($orders_paginate->isEmpty()) {
            return view('fouaille.index', [
                'data' => [],
                'pagination' => [],
                'total_entries' => 0,
                'start_at' => $start_at,
                'end_at' => $end_at,
                'start_at_formatted' => Carbon::parse($start_at)->format('d/m/Y H:i'),
                'end_at_formatted' => Carbon::parse($end_at)->format('d/m/Y H:i'),
                'total_reloads' => 0,
                'total_purchases' => 0
            ]);
        }

        $total_reloads = Order::whereBetween('date', [$start_at, $end_at])
            ->whereNull('product_id')
            ->sum('price');

        $total_purchases = abs(floatval(Order::whereBetween('date', [$start_at, $end_at])
            ->whereNotNull('product_id')
            ->sum('price')));

        // return all products with their total amount and total price
        $product_details = DB::table('orders')
            ->select('products.name', DB::raw('SUM(orders.amount) as amount'), DB::raw('SUM(orders.price) as total'), 'products.color')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->whereBetween('orders.date', [$start_at, $end_at])
            ->groupBy('products.name', 'products.price', 'products.product_type_id', 'products.color')
            ->get();



        return view('fouaille.index', [
            'data' => [
                'orders' => $orders_paginate->map(function ($order) {
                    return [
                        'id' => $order->id,
                        'member' => [
                            'name' => $order->member->last_name . ' ' . $order->member->first_name,
                            'redirect_route' => route('member.show', $order->member->id),
                        ],
                        'price' => $order->product == null ? '<p class="text-success">+ ' . $order->price . '€</p>' : '<p class="text-danger">' . $order->price . '€</p>',
                        'amount' => $order->amount,
                        'product' => $order->product == null ? 'rechargement' : $order->product->name,
                        'type' => $order->product == null ? 'rechargement' : $order->product->productType->type,
                        'date' => Carbon::parse($order->date)->format('d/m/Y H:i')
                    ];
                }),
                'product_details' => $product_details->map(function ($product) {
                    return [
                        'name' => $product->name,
                        'amount' => $product->amount,
                        'total' => abs(floatval($product->total)),
                        'color' => $product->color
                    ];
                }),
            ],
            'pagination' => $orders_paginate->links(),
            'start_at' => $start_at,
            'end_at' => $end_at,
            'start_at_formatted' => Carbon::parse($start_at)->format('d/m/Y H:i'),
            'end_at_formatted' => Carbon::parse($end_at)->format('d/m/Y H:i'),
            'total_purchases' => $total_purchases,
            'total_reloads' => $total_reloads,
        ]);
    }

    public function chart(){

    }
}

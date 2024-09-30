<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ApiOrderController extends Controller
{
    public function index(){

        $start_at = "2021-01-01 00:00:00";

        $orders = $product_details = DB::table('orders')
            ->select('products.name', DB::raw('SUM(orders.amount) as amount'), DB::raw('SUM(orders.price) as total'), 'products.color')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('orders.date', '>=', $start_at)
            ->groupBy('products.name', 'products.price', 'products.product_type_id', 'products.color')
            ->get();

        return response()->json(
            [
                'data' => $orders->map(function ($order) {
                    return [
                        'name' => $order->name,
                        'amount' => $order->amount,
                    ];
                })
            ], 200
        )->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function leaderboard(){

        $start_at = "2024-09-19 16:00:00";
        $end_at = "2024-09-20 01:00:00";

        $orders = $product_details = DB::table('orders')
            ->select(DB::raw('SUM(orders.price) as price'), 'members.first_name', 'members.last_name')
            ->join('members', 'orders.member_id', '=', 'members.id')
            ->where('orders.date', '>=', $start_at)
            ->where('orders.date', '<=', $end_at)
            ->where('orders.price', '<', 0)
            ->orderby('price')
            ->groupBy('members.first_name', 'members.last_name')
            ->get();

        return response()->json(
            [
                'data' => $orders->map(function ($order) {
                    return [
                        'name' => $order->first_name . ' ' . $order->last_name,
                        'total' => $order->price . "€",
                    ];
                })
            ], 200
        )->setEncodingOptions(JSON_PRETTY_PRINT);
    }
}

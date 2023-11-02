<?php

namespace App\Http\Controllers;

use App\Models\Order;

use App\Charts\OrderLineGraph;
use Illuminate\Http\Request;

class FouailleChartsController extends Controller
{
    public function index()
    {
        $start_at = request()->start_at;
        $end_at = request()->end_at;

        $data = Order::select('products.name AS product_name', 'orders.date AS timestamp', 'products.color AS color')
            ->selectRaw('SUM(orders.amount) OVER (PARTITION BY orders.product_id ORDER BY orders.date) AS total_amount')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->whereBetween('orders.date', [$start_at, $end_at])
            ->whereNotNull('orders.product_id')
            ->orderBy('product_name')
            ->orderBy('timestamp')
            ->get();

        $products = $data->pluck('product_name')->unique();

        $time = [];
        $start_at = new \DateTime($start_at);
        $end_at = new \DateTime($end_at);
        $interval = new \DateInterval('PT15M');
        $period = new \DatePeriod($start_at, $interval, $end_at);
        foreach ($period as $dt) {
            $time[] = $dt->format('Y-m-d H:i:s');
        }

        foreach ($products as $product) {
            for ($i = 0; $i < count($time) - 1; $i++) {
                $data_sets[$product]['date'][$i] = $time[$i];
                $data_sets[$product]['amount'][$i] = $data->where('product_name', $product)->where('timestamp', '<=', $time[$i])->pluck('total_amount')->last();
            }
            $data_sets[$product]['color'] = $data->where('product_name', $product)->pluck('color')->first();
        }


        $chart = new OrderLineGraph;

        $chart->labels($time);
        foreach ($products as $product) {
            $chart->dataset($product, 'line', $data_sets[$product]['amount'])
                ->color($data_sets[$product]['color'])->fill(false);
        }



        return view('fouaille.chart.index', compact('chart'));
    }
}

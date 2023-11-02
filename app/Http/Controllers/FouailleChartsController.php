<?php

namespace App\Http\Controllers;

use App\Models\Order;

use App\Charts\OrderLineGraph;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

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

        // take the période between start_at and end_at and split it in (end_at - start_at / 35) intervals and use carbon to do it

        $time = [];
        $start_at = new Carbon($start_at);
        $end_at = new Carbon($end_at);
        $diff = $end_at->diffInMinutes($start_at);
        $interval = $diff / 30;
        for ($i = 0; $i < 30; $i++) {
            $time[$i] = $start_at->addMinutes($interval)->format('Y-m-d H:i:s');
        }

        $data_sets = [];

        foreach ($products as $product) {
            for ($i = 0; $i < count($time) - 1; $i++) {
                $data_sets[$product]['date'][$i] = $time[$i];
                $data_sets[$product]['amount'][$i] = $data->where('product_name', $product)->where('timestamp', '<=', $time[$i])->pluck('total_amount')->last();
            }
            $data_sets[$product]['color'] = $data->where('product_name', $product)->pluck('color')->first();
        }

        $chart = new OrderLineGraph;

        //take $time without the last element
        array_pop($time);

        $chart->labels($time);
        foreach ($products as $product) {
            $chart->dataset($product, 'line', $data_sets[$product]['amount'])
                ->color($data_sets[$product]['color'])
                ->fill(false);
        }

        return view('fouaille.chart.index', [
            'chart' => $chart,
            'is_data' => count($data_sets) > 0 ? true : false,
            'start_at' => $start_at->format('Y-m-d H:i:s'),
            'end_at' => $end_at->format('Y-m-d H:i:s')
        ]);
    }
}

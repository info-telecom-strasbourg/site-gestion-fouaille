<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;

class ApiProductController extends Controller
{
    public function index(){
        return response()
            ->json(['data' =>ProductType::all()->map(function ($product_type) {
                return [
                    'id' => $product_type->id,
                    'product_type' => $product_type->type,
                    'products' => Product::all()->where('product_type_id', '=',$product_type->id)->where('available', '=', true)
                        ->map(function ($product) {
                        return [
                            'id' => $product->id,
                            'name' => $product->name,
                            'title' => $product->title,
                            'price' => $product->price,
                            'color' => $product->color
                        ];
                    })->values()
                ];
            })
        ])->setEncodingOptions(JSON_PRETTY_PRINT);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;

class ApiProductController extends Controller
{
    public function index(){

        $formatted_data = ProductType::all()->map(function ($product_type) {
            $product =  Product::all()->where('id_product_type', '=',$product_type->id)->map(function ($product) {
                return [
                    'id' => $product->id,
                    'product_type' => $product->name,
                    'slug' => $product->slug,
                    'price' => $product->price,
                    'color' => $product->color
                ];
            });
            return [
                'id' => $product_type->id,
                'name' => $product_type->type,
                'products' => $product->values()
            ];
        });

        return response()->json(['data' =>$formatted_data])->setEncodingOptions(JSON_PRETTY_PRINT);
    }

}

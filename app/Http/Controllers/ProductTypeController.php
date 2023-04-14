<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function index()
    {
        return view('products.index', [
            'product_types' => ProductType::all(),
        ]);
    }
}

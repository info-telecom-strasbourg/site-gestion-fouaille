<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index', [
            'products' => Product::all(),
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|max:255',
            'type' => 'required|max:255'
        ]);

        Product::create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'product_type' => $validatedData['type']
        ]);

        return back();
    }
}

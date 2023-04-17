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
            'id_product_type' => 'required|integer'
        ]);


        Product::create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'id_product_type' => $validatedData['id_product_type'],
        ]);

        return back();
    }

    public function destroy($id){
        Product::findOrFail($id)->delete();
        return back();
    }
}

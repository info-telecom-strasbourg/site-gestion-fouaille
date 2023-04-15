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

    public function store(Request $request){

        $validatedData = $request->validate([
            'type' => 'required|max:255'
        ]);

        ProductType::create([
            'type' => $validatedData['type'],
        ]);

        return back();
    }


    public function destroy(ProductType $productType){
        dd($productType);
        $productType->delete();
        return back();
    }
}

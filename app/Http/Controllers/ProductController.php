<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

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
            'name' => 'required|max:255|unique:products',
            'title' => 'required|max:255|unique:products',
            'price' => 'required|max:255',
            'color' => 'required|max:255',
            'product_type_id' => 'required|integer'
        ]);

        Product::create([
            'name' => $validatedData['name'],
            'title' => $validatedData['title'],
            'price' => $validatedData['price'],
            'color' => $validatedData['color'],
            'product_type_id' => $validatedData['product_type_id'],
        ]);

        return back();
    }

    public function destroy($id){
        Product::findOrFail($id)->delete();
        return back();
    }
}

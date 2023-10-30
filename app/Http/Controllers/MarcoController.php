<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class MarcoController extends Controller
{
    public function index()
    {
        $products = Product::all();

        if ($products == null) {
            return view('marco.index', [
                'data' => [],
            ]);
        }

        return view('marco.index', [
            'data' => $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'product_type_name' => $product->productType->type,
                    'color' => $product->color,
                    'available' => $product->available ? '<span class="text-success">Disponible</span>' : '<span class="text-danger">Indisponible</span>',
                ];
            }),
        ]);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if ($product == null) {
            return view('marco.show', [
                'data' => [],
            ]);
        }

        return view('marco.show', [
            'data' => [
                'id' => $product->id,
                'name' => $product->name,
                'title' => $product->title,
                'price' => $product->price,
                'type' => $product->productType->type,
                'color' => $product->color,
                'available' => $product->available ? '<span class="text-success">Oui</span>' : '<span class="text-danger">Non</span>',
            ],
        ]);

    }

    public function edit($id){
        $product = Product::find($id);

        if ($product == null) {
            return view('marco.edit', [
                'data' => [],
            ]);
        }

        return view('marco.edit', [
            'data' => [
                'id' => $product->id,
                'name' => $product->name,
                'title' => $product->title,
                'price' => $product->price,
                'color' => $product->color,
                'available' => $product->available
            ],
        ]);
    }

    public function update($id)
    {
        $product = Product::find($id);

        if ($product == null) {
            return view('product.show', [
                'data' => []
            ]);
        }


        $validateData = request()->validate([
            'name' => 'max:50',
            'title' => 'max:25',
            'price' => 'numeric',
            'color' => 'max:50',
            'available' => 'string'
        ]);


        if (array_key_exists('available', $validateData)) {
            $validateData['available'] = 1;
        }else{
            $validateData['available'] = 0;
        }

        $product->update($validateData);
        session()->flash('success', 'Produit modifié avec succès !');

        return redirect('/marco/' . $id . '/edit');
    }


    public function create()
    {
        $product_types = ProductType::all();

        return view('marco.create', [
          'data' => $product_types->map(function ($product_type) {
              return [
                  'id' => $product_type->id,
                  'type' => $product_type->type,
              ];
          }),
        ]);
    }
    public function store()
    {
        $validateData = request()->validate([
            'name' => 'required|max:50',
            'title' => 'required|max:25',
            'price' => 'required|numeric',
            'color' => 'required|max:50',
            'product_type_id' => 'required|integer|exists:product_types,id'
        ]);

        Product::create($validateData);
        session()->flash('success', 'Produit ' . $validateData['name'] . ' créé avec succès !');

        return redirect()->route('marco.index');
    }
}

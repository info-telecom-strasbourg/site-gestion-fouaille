<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ApiProductController extends Controller
{
    public function index(){
        return Product::all()->toJson(JSON_PRETTY_PRINT);
    }

}

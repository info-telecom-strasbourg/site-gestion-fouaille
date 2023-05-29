<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    public function index(){
        return Product::all()->toJson(JSON_PRETTY_PRINT);
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductType;

class ApiProductTypeController extends Controller
{
    public function index(){
        return response()->json(['data' => ProductType::all()])->setEncodingOptions(JSON_PRETTY_PRINT);
    }
}

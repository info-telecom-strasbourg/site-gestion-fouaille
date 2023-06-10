<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;

use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

class ApiOrganizationController extends Controller
{
    public function index(){
        return response()->json(['data' => Organization::all()])->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function indexSmall(){
        return response()->json(['data' => Organization::select('id', 'slug', 'name', 'logo_link')->get()])->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function show($id){
        return response()->json(['data' => Organization::find($id)])->setEncodingOptions(JSON_PRETTY_PRINT);
    }

}

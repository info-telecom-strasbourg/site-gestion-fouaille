<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;

use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

class ApiOrganizationController extends Controller
{
    public function index(){
        $associations = Organization::where('association', '=', 1)->get();
        $clubs = Organization::where('association', '=', 0)->get();

        return response()->json(['data' => [
            'associations' => $associations,
            'clubs' => $clubs
        ]
        ])->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function indexSmall(){

        $association = Organization::select('id', 'slug', 'name', 'logo_link')->where('association', '=', 1)->get();
        $clubs = Organization::select('id', 'slug', 'name', 'logo_link')->where('association', '=', 0)->get();

        return response()->json(['data' => [
            'associations' => $association,
            'clubs' => $clubs
        ]])->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function show($id){
        return response()->json(['data' => Organization::find($id)])->setEncodingOptions(JSON_PRETTY_PRINT);
    }

}

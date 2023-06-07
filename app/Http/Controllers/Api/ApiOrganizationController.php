<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use illuminate\Http\Request;

class ApiOrganizationController extends Controller
{
    public function index(){
        return Organization::all()->toJson(JSON_PRETTY_PRINT);
    }

    public function indexSmall(){
        $organization = Organization::select('id', 'slug', 'name', 'logo_link')->get();

        return $organization->toJson(JSON_PRETTY_PRINT);
    }

    public function show(Request $request, $id){
        return Organization::find($id)->toJson(JSON_PRETTY_PRINT);
    }
}

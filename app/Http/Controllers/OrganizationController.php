<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller{
    public function index(){
        return view('organizations.index', [
            'organizations' => Organization::latest('id')->paginate(50)->withQueryString()
        ]);
    }

    public function store(Request $request){

        dd($request->all());

        $validatedData = $request->validate([
            'type' => 'required|max:255|unique:product_types'
        ]);


        return back();
    }
}

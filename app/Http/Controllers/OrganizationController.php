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
}

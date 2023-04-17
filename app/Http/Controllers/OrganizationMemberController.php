<?php

namespace App\Http\Controllers;

use App\Models\OrganizationMember;
use Illuminate\Http\Request;

class OrganizationMemberController extends Controller
{
    public function index(){
        return view('organizations.index', [
            'organizations' => OrganizationMember::latest('id')->paginate(50)->withQueryString()
        ]);
    }
}

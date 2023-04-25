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

    public function store(Request $request){

        $validatedData = $request->validate([
            'role' => 'required|max:50',
            'id_member' => 'required|exists:members,id',
            'id_organization' => 'required|exists:organizations,id'
        ]);

        OrganizationMember::create([
            'role' => $validatedData['role'],
            'id_member' => $validatedData['id_member'],
            'id_organization' => $validatedData['id_organization']
        ]);

        return back();
    }
}

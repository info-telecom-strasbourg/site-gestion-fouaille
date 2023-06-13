<?php

namespace App\Http\Controllers;

use App\Models\OrganizationMember;
use Illuminate\Http\Request;

class OrganizationMemberController extends Controller
{
    public function index(){
        return view('organization.index', [
            'organization' => OrganizationMember::latest('id')->paginate(50)->withQueryString()
        ]);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'role' => 'required|max:50',
            'member_id' => 'required|exists:members,id',
            'organization_id' => 'required|exists:organization,id'
        ]);

        OrganizationMember::create([
            'role' => $validatedData['role'],
            'member_id' => $validatedData['member_id'],
            'organization_id' => $validatedData['organization_id']
        ]);

        return back();
    }
}

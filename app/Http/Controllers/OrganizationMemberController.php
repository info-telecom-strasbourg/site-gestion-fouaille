<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Organization;
use App\Models\OrganizationMember;
use Illuminate\Http\Request;

class OrganizationMemberController extends Controller
{
    public function index(){
        return view('organization.index', [
            'organization' => OrganizationMember::latest('id')->paginate(50)->withQueryString()
        ]);
    }

    public function update($id){

        return view('asso.member.update', [
            'data' => [
                'organization' => array_filter(Organization::findOrfail($id)->toArray(), function ($key) {
                    return $key == 'id' || $key == 'short_name';
                }, ARRAY_FILTER_USE_KEY),
                'members' => Member::OrderBy('last_name')->OrderBy('first_name')->get()->map(function ($member) {
                    return [
                        'id' => $member->id,
                        'first_name' => $member->first_name,
                        'last_name' => $member->last_name,
                        'is_member' => OrganizationMember::where('member_id', $member->id)->where('organization_id', request()->route('id'))->exists() ? 1 : 0
                    ];
                })
            ]
        ]);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'role' => 'required|max:50|min:3',
            'member_id' => 'required|exists:members,id',
            'organization_id' => 'required|exists:organizations,id'
        ]);

        OrganizationMember::create([
            'role' => $validatedData['role'],
            'member_id' => $validatedData['member_id'],
            'organization_id' => $validatedData['organization_id']
        ]);

        $member = Member::findOrfail($validatedData['member_id']);
        $organization = Organization::findOrfail($validatedData['organization_id']);

        session()->flash('success', 'Le membre ' . $member->first_name . ' ' . $member->last_name . ' a bien été ajouté à l\'association ' . $organization->name . ' en tant que ' . $validatedData['role'] . '.');

        return redirect()->route('asso.show', $validatedData['organization_id']);
    }

    public function destroy($id){
        $organizationMember = OrganizationMember::findOrfail($id);
        $organizationMember->delete();

        session()->flash('success', 'Le membre a bien été retiré de l\'association.');

        return redirect()->route('asso.show', $organizationMember->organization_id);
    }
}

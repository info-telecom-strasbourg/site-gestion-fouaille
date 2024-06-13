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

    public function create($id){

        return view('asso.member.create', [
            'data' => [
                'organization' => array_filter(Organization::findOrfail($id)->toArray(), function ($key) {
                    return $key == 'id' || $key == 'short_name';
                }, ARRAY_FILTER_USE_KEY),
                'members' => Member::OrderBy('last_name')->OrderBy('first_name')->get()->map(function ($member) {
                    return [
                        'id' => $member->id,
                        'name' => $member->first_name . ' ' . $member->last_name,
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

    public function delete($memberid,$assoid){

        $name = Member::findOrfail($memberid);
        $member = OrganizationMember::Where('member_id',$memberid)->Where('organization_id',$assoid);;
        if ($member == null) {
            return view('asso.show', [
                'data' => []
            ]);
        }

        $member->delete();

        session()->flash('success', $name->first_name . ' ' . $name->last_name . ' supprimé(e) avec succès !');

        return redirect()->route('asso.show', $assoid);
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Organization;
use App\Models\OrganizationMember;
use Illuminate\Http\Request;

class OrganizationMemberController extends Controller
{

    public function index($id){

        $members = Member::filter(request(['search']))->paginate(30)->withQueryString();

        return view('asso.member.index', [
            'data' => [
                'organization' => array_filter(Organization::findOrfail($id)->toArray(), function ($key) {
                    return $key == 'id' || $key == 'short_name';
                }, ARRAY_FILTER_USE_KEY),
                'members' => [
                    'all' => $members->map(function ($member) use ($id) {
                        if (!$member->InOrganization($id)) {
                            return [
                                'id' => $member->id,
                                'first_name' => $member->first_name,
                                'last_name' => $member->last_name,
                                'organization_member_id' => null
                            ];
                        }

                        return null;
                    })->reject(function ($member) { // Remove null values
                        return $member == null;
                    }),
                    'organization' => Organization::findOrfail($id)->members->map(function ($member) {
                        return [
                            'id' => $member->id,
                            'first_name' => $member->first_name,
                            'last_name' => $member->last_name,
                            'role' => $member->pivot->role
                        ];
                    })
                ]
            ],
            'pagination' => $members->links()
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

    public function destroy(){
        $validatedData = request()->validate([
            'member_id' => 'required|exists:members,id',
            'organization_id' => 'required|exists:organizations,id'
        ]);


        OrganizationMember::where('organization_id', $validatedData['organization_id'])
            ->where('member_id', $validatedData['member_id'])->delete();

        session()->flash('success', 'Le membre a bien été retiré de l\'association.');

        return redirect()->route('asso.show', $validatedData['organization_id']);
    }

    public function edit($organization_id, $member_id){

        $organization = Organization::findOrfail($organization_id);
        $member = $organization->members->find($member_id);


        return view('asso.member.edit', [
            'data' => [
                'first_name' => $member->first_name,
                'last_name' => $member->last_name,
                'organization_name' => $organization->name,
                'organization_id' => $organization->id,
                'member_id' => $member->id,
                'role' => $member->pivot->role
            ]
        ]);
    }

    public function update(){
        dd(request()->all());
        $validatedData = request()->validate([
            'role' => 'required|max:50|min:3',
            'member_id' => 'required|exists:members,id',
            'organization_id' => 'required|exists:organizations,id'
        ]);


        OrganizationMember::where('organization_id', $validatedData['organization_id'])
            ->where('member_id', $validatedData['member_id'])
            ->update(['role' => $validatedData['role']]);

        session()->flash('success', 'Le rôle du membre a bien été mis à jour.');

        return redirect()->route('asso.member.index', $validatedData['organization_id']);
    }
}

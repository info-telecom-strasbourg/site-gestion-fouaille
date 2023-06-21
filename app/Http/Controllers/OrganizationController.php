<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\OrganizationMember;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrganizationController extends Controller{
    public function index(){

        $datas = Organization::all()->map(function ($organization){
            $members = '';
            foreach (OrganizationMember::where('organization_id', '=', $organization->id)->get() as $member){
                $members .= $member->member->first_name . ' ' . $member->member->last_name . ' (' . $member->member->user_name . ')'. ' - ' . $member->role . ' | ';
            }
            return [
                'members' => $members,
                'organization' => $organization
            ];
        });

        return view('organization.index', [
            'datas' => $datas
        ]);
    }
}

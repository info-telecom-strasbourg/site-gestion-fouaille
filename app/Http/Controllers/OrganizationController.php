<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\OrganizationMember;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrganizationController extends Controller{
    public function index(){

        $organizations = Organization::orderBy('name')->get();

        if ($organizations == null) {
            return view('asso.index', [
                'data' => []
            ]);
        }

        $datas = $organizations->map(function ($organization) {
            return [
                'id' => $organization->id,
                'name' => $organization->name,
                'logo' => $organization->getLogoPath(),
                'email' => $organization->email,
                'website_link' => $organization->website_link,
                'association' => $organization->association == 1 ? 'Oui' : 'Non',
            ];
        });


        return view('asso.index', [
            'data' => $datas
        ]);
    }

    public function show($request){
        $organization = Organization::find($request);

        if ($organization == null) {
            return view('asso.show', [
                'data' => []
            ]);
        }

        $datas = [
            'id' => $organization->id,
            'name' => $organization->name,
            'short_name' => $organization->short_name,
            'description' => $organization->description,
            'Logo' => $organization->getLogoPath(),
            'email' => $organization->email,
            'website_link' => $organization->website_link,
            'association' => $organization->association == 1 ? 'Oui' : 'Non',
            'facebook_link' => $organization->facebook_link,
            'twitter_link' => $organization->twitter_link,
            'instagram_link' => $organization->instagram_link,
            'discord_link' => $organization->discord_link,
        ];

        return view('asso.show', [
            'data' => $datas
        ]);
    }
}

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
                'Id' => $organization->id,
                'Nom' => $organization->name,
                'Logo' => $organization->getLogoPath(),
                'Email' => $organization->email,
                'Site web' => $organization->website_link,
                'Association' => $organization->association == 1 ? 'Oui' : 'Non',
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
            'Id' => $organization->id,
            'Nom' => $organization->name,
            'Nom court' => $organization->short_name,
            'Description' => $organization->description,
            /*'Logo' => $organization->getLogoPath(),*/
            'Logo' => 'https://picsum.photos/200',
            'Email' => $organization->email,
            'Site web' => $organization->website_link,
            'Association' => $organization->association == 1 ? 'Oui' : 'Non',
            'Facebook' => $organization->facebook_link,
            'Twitter' => $organization->twitter_link,
            'Instagram' => $organization->instagram_link,
            'Discord' => $organization->discord_link,
        ];

        return view('asso.show', [
            'data' => $datas
        ]);
    }
}

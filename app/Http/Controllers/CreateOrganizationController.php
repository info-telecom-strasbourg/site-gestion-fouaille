<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class CreateOrganizationController extends Controller
{
    public function index(){
        return view('organization.create');
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'acronym' => 'required|max:50|unique:organization',
            'name' => 'required|max:50|unique:organization',
            'description' => 'nullable|max:1048',
            'website_link' => 'nullable|url|max:255',
            'facebook_link' => 'nullable|url|max:255',
            'twitter_link' => 'nullable|url|max:255',
            'instagram_link' => 'nullable|url|max:255',
            'discord_link' => 'nullable|url|max:255',
            'logo' => 'nullable|url|max:255',
            'association' => 'in:"on","off"'
        ]);


        Organization::create([
            'acronym' => $validatedData['slug'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'website_link' => $validatedData['website_link'],
            'facebook_link' => $validatedData['facebook_link'],
            'twitter_link' => $validatedData['twitter_link'],
            'instagram_link' => $validatedData['instagram_link'],
            'discord_link' => $validatedData['discord_link'],
            'logo' => $validatedData['logo_link'],
            'association' => array_key_exists('association', $validatedData) ?
                $validatedData['association'] ? 1 : 0 : 0
        ]);

        return route('organization.index');
    }
}

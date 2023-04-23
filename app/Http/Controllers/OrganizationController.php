<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrganizationController extends Controller{
    public function index(){
        return view('organizations.index', [
            'organizations' => Organization::latest('id')->paginate(50)->withQueryString()
        ]);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'slug' => 'required|max:50|unique:organizations',
            'name' => 'required|max:50|unique:organizations',
            'description' => 'nullable|max:1048',
            'website_link' => 'nullable|url|max:255',
            'facebook_link' => 'nullable|url|max:255',
            'twitter_link' => 'nullable|url|max:255',
            'instagram_link' => 'nullable|url|max:255',
            'discord_link' => 'nullable|url|max:255',
            'logo_link' => 'nullable|url|max:255',
            'association' => 'in:"on","off"'
        ]);


        Organization::create([
            'slug' => $validatedData['slug'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'website_link' => $validatedData['website_link'],
            'facebook_link' => $validatedData['facebook_link'],
            'twitter_link' => $validatedData['twitter_link'],
            'instagram_link' => $validatedData['instagram_link'],
            'discord_link' => $validatedData['discord_link'],
            'logo_link' => $validatedData['logo_link'],
            'association' => array_key_exists('association', $validatedData) ?
                $validatedData['association'] ? 1 : 0 : 0
        ]);

        return back();
    }
}

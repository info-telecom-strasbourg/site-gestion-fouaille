<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;

use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

class ApiOrganizationController extends Controller
{
    public function index(){

        $associations = Organization::select('id', 'acronym', 'name', 'logo')->where('association', '=', 1)->get();
        $associations_tab = $associations->map(function ($asso) {
            return [
                'id' => $asso->id,
                'acronym' => $asso->acronym,
                'name' => $asso->name,
                'logo_url' => $asso->getLogoPath()
            ];
        })->values();

        $clubs = Organization::select('id', 'acronym', 'name', 'logo')->where('association', '=', 0)->get();
        $clubs_tab = $clubs->map(function ($club) {
            return [
                'id' => $club->id,
                'acronym' => $club->acronym,
                'name' => $club->name,
                'logo_url' => $club->getLogoPath()
            ];
        })->values();

        return response()->json(['data' => [
            'associations' => $associations_tab,
            'clubs' => $clubs_tab
        ]])->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function show($id){
        $organization = Organization::all()->where('id', '=', $id)->first();
        $organization_tab = [
                'acronym' => $organization->acronym,
                'name' => $organization->name,
                'description' => $organization->description,
                'website_link' => $organization->website_link,
                'facebook_link' => $organization->facebook_link,
                'twitter_link' => $organization->twitter_link,
                'instagram_link' => $organization->instagram_link,
                'discord_link' => $organization->discord_link,
                'logo_url' => $organization->getLogoPath(),
            ];
        return response()->json(['data' => $organization_tab])->setEncodingOptions(JSON_PRETTY_PRINT);
    }

}

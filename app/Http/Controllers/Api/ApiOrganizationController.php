<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;

use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

class ApiOrganizationController extends Controller
{
    public function index(){

        $organization = Organization::filter(request(['search']))->get();

        $associations = $organization->where('association', '=', 1); // 1 = association

        if ($associations->isEmpty()) {
            $associations_tab = [];
        }else{
            $associations_tab = $associations->map(function ($asso) {
                return [
                    'id' => $asso->id,
                    'short_name' => $asso->short_name,
                    'name' => $asso->name,
                    'logo_url' => $asso->logo->path
                ];
            })->values();
        }


        $clubs = $organization->where('association', '=', 0); // 0 = club

        if ($clubs->isEmpty()) {
            $clubs_tab = [];
        }else{
            $clubs_tab = $clubs->map(function ($club) {
                return [
                    'id' => $club->id,
                    'short_name' => $club->short_name,
                    'user_name' => $club->user_name,
                    'name' => $club->name,
                    'logo_url' => $club->logo->path
                ];
            })->values();
        }

        return response()->json(['data' => [
            'associations' => $associations_tab,
            'clubs' => $clubs_tab,
        ]])->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function show($id){
        $organization = Organization::all()->where('id', '=', $id)->first();

        if ($organization == null) {
            return response()->json(['data' => []])->setEncodingOptions(JSON_PRETTY_PRINT);
        }

        $organization_tab = [
                'id' => $organization->id,
                'short_name' => $organization->short_name,
                'name' => $organization->name,
                'user_name' => null,
                'description' => $organization->description,
                'website_link' => $organization->website_link,
                'facebook_link' => $organization->facebook_link,
                'twitter_link' => $organization->twitter_link,
                'instagram_link' => $organization->instagram_link,
                'discord_link' => $organization->discord_link,
                'email' => $organization->email,
                'logo_url' => $organization->logo->path,
            ];

        $members_tab = $organization->members->map(function ($member) use ($id) {
            return [
                'id' => $member->id,
                'role' => $member->role,
                'first_name' => $member->first_name,
                'last_name' => $member->last_name,
            ];
        })->values();
        
        return response()->json([
            'organization' => $organization_tab,
            'members' => $members_tab,
        ])->setEncodingOptions(JSON_PRETTY_PRINT);
    }

}

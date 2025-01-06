<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

class ApiCampagnesController extends Controller
{
    public function index(){

        return response()->json(['data' => [
            'listes' => [
                [
                    'id' => 1,
                    'short_name' => "",
                    'name' => "Sambaliste",
                    'logo_url' => "https://via.placeholder.com/150"
                ],
                [
                    'id' => 2,
                    'short_name' => "",
                    'name' => "Jeux de sociétéliste",
                    'logo_url' => "https://via.placeholder.com/150"
                ],
                [
                    'id' => 3,
                    'short_name' => "",
                    'name' => "Italiste",
                    'logo_url' => "https://via.placeholder.com/150"
                ],
                [
                    'id' => 4,
                    'short_name' => "",
                    'name' => "Charliste et la chocolaterie",
                    'logo_url' => "https://via.placeholder.com/150"
                ]
            ],
        ]])->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function show($id){
        switch ($id) {
            case 1:
                return response()->json(['data' => [
                    'id' => 1,
                    'short_name' => "",
                    'name' => "Sambaliste",
                    'logo_url' => "https://via.placeholder.com/150",
                    'description' => "",
                    'website_link' => "https://www.sambaliste.com",
                    'facebook_link' => "https://www.facebook.com/sambaliste",
                    'instagram_link' => "https://www.instagram.com/sambaliste"
                ]])->setEncodingOptions(JSON_PRETTY_PRINT);
                break;
            case 2:
                return response()->json(['data' => [
                    'id' => 2,
                    'short_name' => "",
                    'name' => "Jeux de sociétéliste",
                    'logo_url' => "https://via.placeholder.com/150",
                    'description' => "",
                    'website_link' => "https://www.sambaliste.com",
                    'facebook_link' => "https://www.facebook.com/sambaliste",
                    'instagram_link' => "https://www.instagram.com/sambaliste"
                ]])->setEncodingOptions(JSON_PRETTY_PRINT);
                break;
            case 3:
                return response()->json(['data' => [
                    'id' => 3,
                    'short_name' => "",
                    'name' => "Italiste",
                    'logo_url' => "https://via.placeholder.com/150",
                    'description' => "",
                    'website_link' => "https://www.sambaliste.com",
                    'facebook_link' => "https://www.facebook.com/sambaliste",
                    'instagram_link' => "https://www.instagram.com/sambaliste"
                ]])->setEncodingOptions(JSON_PRETTY_PRINT);
                break;
            case 4:
                return response()->json(['data' => [
                    'id' => 4,
                    'short_name' => "",
                    'name' => "Charliste et la chocolaterie",
                    'logo_url' => "https://via.placeholder.com/150",
                    'description' => "",
                    'website_link' => "https://www.sambaliste.com",
                    'facebook_link' => "https://www.facebook.com/sambaliste",
                    'instagram_link' => "https://www.instagram.com/sambaliste"
                ]])->setEncodingOptions(JSON_PRETTY_PRINT);
                break;
            default:
                return response()->json(['data' => [
                    'id' => 0,
                    'short_name' => "",
                    'name' => "Campagne inconnue",
                    'logo_url' => "",
                    'description' => "",
                    'website_link' => "",
                    'facebook_link' => "",
                    'instagram_link' => ""
                ]])->setEncodingOptions(JSON_PRETTY_PRINT);
                break;
        }
    }
}
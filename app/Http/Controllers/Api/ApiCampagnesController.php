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
                    'logo_url' => "https://fouaille.bde-tps.fr/storage/images/organization_logo/257_1736418261_Braziliste_255.jpg"
                ],
                [
                    'id' => 2,
                    'short_name' => "",
                    'name' => "Jeux de sociétéliste",
                    'logo_url' => "https://fouaille.bde-tps.fr/storage/images/organization_logo/258_1736418270_Thierceliste_416.jpg"
                ],
                [
                    'id' => 3,
                    'short_name' => "",
                    'name' => "Italiste",
                    'logo_url' => "https://fouaille.bde-tps.fr/storage/images/organization_logo/255_1736418230_Napoliste_647.jpg"
                ],
                [
                    'id' => 4,
                    'short_name' => "",
                    'name' => "Charliste et la chocolaterie",
                    'logo_url' => "https://fouaille.bde-tps.fr/storage/images/organization_logo/256_1736418249_Williste_26.jpg"
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
                    'logo_url' => "https://fouaille.bde-tps.fr/storage/images/organization_logo/257_1736418261_Braziliste_255.jpg",
                    'description' => "",
                    'website_link' => "https://braziliste.bde-tps.fr/",
                    'facebook_link' => "https://www.facebook.com/groups/367161756197019/user/61569400475869?locale=fr_FR",
                    'instagram_link' => "https://www.instagram.com/braziliste_tps/"
                ]])->setEncodingOptions(JSON_PRETTY_PRINT);
                break;
            case 2:
                return response()->json(['data' => [
                    'id' => 2,
                    'short_name' => "",
                    'name' => "Jeux de sociétéliste",
                    'logo_url' => "https://fouaille.bde-tps.fr/storage/images/organization_logo/258_1736418270_Thierceliste_416.jpg",
                    'description' => "",
                    'website_link' => "https://loupgaroudethierceliste.bde-tps.fr/",
                    'facebook_link' => "https://www.facebook.com/groups/367161756197019/user/61569013302322/?locale=fr_FR",
                    'instagram_link' => "https://www.instagram.com//loup_garou_de_thierceliste_tps/"
                ]])->setEncodingOptions(JSON_PRETTY_PRINT);
                break;
            case 3:
                return response()->json(['data' => [
                    'id' => 3,
                    'short_name' => "",
                    'name' => "Italiste",
                    'logo_url' => "https://fouaille.bde-tps.fr/storage/images/organization_logo/255_1736418230_Napoliste_647.jpg",
                    'description' => "",
                    'website_link' => "https://napoliste.bde-tps.fr/",
                    'facebook_link' => "https://www.facebook.com/groups/367161756197019/user/61569420170146/?locale=fr_FR",
                    'instagram_link' => "https://www.instagram.com/napoliste.tps/"
                ]])->setEncodingOptions(JSON_PRETTY_PRINT);
                break;
            case 4:
                return response()->json(['data' => [
                    'id' => 4,
                    'short_name' => "",
                    'name' => "Charliste et la chocolaterie",
                    'logo_url' => "https://fouaille.bde-tps.fr/storage/images/organization_logo/256_1736418249_Williste_26.jpg",
                    'description' => "",
                    'website_link' => "https://willistewonka.bde-tps.fr/",
                    'facebook_link' => "https://www.facebook.com/groups/367161756197019/user/61568556437645/?locale=fr_FR",
                    'instagram_link' => "https://www.instagram.com/williste_wonka/"
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
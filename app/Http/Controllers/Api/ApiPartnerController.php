<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partner;

use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

class ApiPartnerController extends Controller
{
    public function index(){

        $partners = Partner::all();

        if ($partners->isEmpty()) {
            $partners_tab = [];
        }else{
            $partners_tab = $partners->map(function ($part) {
                return [
                    'id' => $part->id,
                    'name' => $part->name,
                    'logo_url' => $part->logo->path,
                    'description' => $part->description
                ];
            })->values();
        }


        return response()->json(['data' => [
            'partner' => $partners_tab,
        ]])->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function show($id){
        $partner = Partner::all()->where('id', '=', $id)->first();

        if ($partner == null) {
            return response()->json(['data' => []])->setEncodingOptions(JSON_PRETTY_PRINT);
        }

        $partner_tab = [
                'name' => $partner->name,
                'promo' => $partner->promo,
                'description' => $partner->description,
                'website_link' => $partner->website_link,
                'email' => $partner->email,
                'logo_url' => $partner->logo->path,
            ];
        return response()->json(['data' => $partner_tab])->setEncodingOptions(JSON_PRETTY_PRINT);
    }
}

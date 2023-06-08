<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;

use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

class ApiOrganizationController extends Controller
{
    public function index(){
        return response()->json(['data' => Organization::all()])->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function indexSmall(){
        return response()->json(['data' => Organization::select('id', 'slug', 'name', 'logo_link')->get()])->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function show($id){
        return response()->json(['data' => Organization::find($id)])->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function image(Request $request, $id){

        $image_url = Organization::find($id)->logo_link;
        if (!filter_var($image_url, FILTER_VALIDATE_URL)){ // If the url is not valid
            return response()->json([
                'message' => 'No image found for this organization'
            ], 404);
        }

        // Get the path of the image from the url (without the domain name) from https://www.aidantsnature.fr/storage/organizations/1/1.png to absolute path of the image
        $image_path = public_path(parse_url($image_url, PHP_URL_PATH));

        $new_size = $request->query('size');
        if ($new_size == null){ // If no size is specified, return the original image
            return redirect()->away($image_url);
        }

        $image = Image::make($image_path);

        $image->resize($new_size, $new_size, function($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        return $image->response('png');
    }
}

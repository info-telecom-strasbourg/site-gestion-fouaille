<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrganizationLogoController extends Controller
{
    function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'logo' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg',
                'max:2048'
            ]
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validation->errors()
            ], 422);
        }


        $user = $request->user();

        if ($user->avatar->name != 'default.png') {
            Storage::delete('public/images/avatars/' . $user->avatar->name);
            $user->avatar->delete();
        }

        $avatar = $request->file('avatar');

        $name = $user->id . '_' . time() . '_' . $user->last_name . '_' . $user->first_name . '_' . random_int(0, 1000) . '.' . $avatar->getClientOriginalExtension();

        $stored_path = $avatar->storeAs('public/images/organization_logo', $name);

        $user->avatar()->create([
            'name' => $name,
            'path' => asset('storage/images/organization_logo/' . $name),
            'size' => $avatar->getSize()
        ]);

        return response()->json([
            'message' => 'Logo uploaded successfully',
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrganizationLogoController extends Controller
{
    function store(Request $request)
    {
        $validation = request()->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $organization = Organization::find($request->id);

        if ($organization->logo->name != 'default.png') {
            $organization->logo->delete();
        }

        $logo = $request->file('logo');

        $name = $organization->id . '_' . time() . '_' . $organization->name . '_' . random_int(0, 1000) . '.' . $logo->getClientOriginalExtension();

        $stored_path = $logo->storeAs('public/images/organization_logo', $name);

        $organization->logo()->create([
            'name' => $name,
            'path' => asset('storage/images/organization_logo/' . $name),
            'size' => $logo->getSize()
        ]);

        session()->flash('success', 'Logo modifiée avec succès !');

        return back();
    }
}

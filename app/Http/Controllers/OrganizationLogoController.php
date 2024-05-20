<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrganizationLogoController extends Controller
{

    public function update(Request $request)
    {
        $organization = Organization::find($request->id);

        $validation = request()->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $logo = $request->file('logo');

        $name = $organization->id . '_' . time() . '_' . $organization->name . '_' . random_int(0, 1000) . '.' . $logo->getClientOriginalExtension();

        $logo->storeAs('public/images/organization_logo', $name);

        if ($organization->logo->name != 'default.png') {

            Storage::delete('public/images/organization_logo/' . $organization->logo->name);

            $organization->logo()->update([
                'name' => $name,
                'path' => asset('storage/images/organization_logo/' . $name),
                'size' => $logo->getSize()
            ]);
        } else {
            $organization->logo()->create([
                'name' => $name,
                'path' => asset('storage/images/organization_logo/' . $name),
                'size' => $logo->getSize()
            ]);
        }


        session()->flash('success', 'Logo modifiée avec succès !');

        return back();
    }

}

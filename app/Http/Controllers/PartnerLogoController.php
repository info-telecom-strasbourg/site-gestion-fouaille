<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PartnerLogoController extends Controller
{

    public function update(Request $request)
    {
        $partner = Partner::find($request->id);

        $validation = request()->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $logo = $request->file('logo');

        $name = $partner->id . '_' . time() . '_' . $partner->name . '_' . random_int(0, 1000) . '.' . $logo->getClientOriginalExtension();

        $logo->storeAs('public/images/partner_logo', $name);

        if ($partner->logo->name != 'default.png') {

            Storage::delete('public/images/partner_logo/' . $partner->logo->name);

            $partner->logo()->update([
                'name' => $name,
                'path' => asset('storage/images/partner_logo/' . $name),
                'size' => $logo->getSize()
            ]);
        } else {
            $partner->logo()->create([
                'name' => $name,
                'path' => asset('storage/images/partner_logo/' . $name),
                'size' => $logo->getSize()
            ]);
        }


        session()->flash('success', 'Logo modifié avec succès !');

        return back();
    }

}

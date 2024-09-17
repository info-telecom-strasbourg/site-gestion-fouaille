<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PartnerController extends Controller{
    public function index(){

        request()->validate([
            'order_by' => 'string|in:name',
            'order_direction' => 'string|in:asc,desc',
            'search' => 'string'
        ]);

        if (isset(request()->order_by)) {
            $order_by = request()->order_by;
        } else {
            $order_by = 'name';
            request()->merge([
                'order_by' => 'name'
            ]);
        }

        if (isset(request()->order_direction)) {
            $order_direction = request()->order_direction;
        } else {
            $order_direction = 'desc';
            request()->merge([
                'order_direction' => 'desc'
            ]);
        }

        $partners = partner::order($order_by, $order_direction)
            ->filter(request(['search']))
            ->paginate(10)->withQueryString();

        if ($partners == null) {
            return view('spons.index', [
                'data' => []
            ]);
        }

        $datas = $partners->map(function ($partner) {
            return [
                'id' => $partner->id,
                'name' => [
                    'name' => $partner->name,
                    'redirect_route' => route('spons.show', $partner->id)
                ],
                'logo' => '<img src="'. $partner->logo->path .'" alt="Logo" class="img-fluid" style="max-width: 100px;">',
                'email' => $partner->email,
                'promo' => $partner->promo,
            ];
        });


        return view('spons.index', [
            'data' => $datas,
            'pagination' => $partners->links()
        ]);
    }

    public function show($request){

        $partner = partner::find($request);

        if ($partner == null) {
            return view('spons.show', [
                'data' => []
            ]);
        }

        $partner_members = $partner->members;

        return view('spons.show', [
            'data' => [
                'id' => $partner->id,
                'name' => $partner->name,
                'promo' => $partner->promo,
                'description' => $partner->description,
                'logo' => $partner->logo->path,
                'email' => $partner->email,
                'website_link' => $partner->website_link,
            ]
        ]);
    }

    public function edit($request)
    {
        $partner = partner::find($request);
        if ($partner == null) {
            return view('spons.edit', [
                'data' => []
            ]);
        }

        return view('spons.edit', [
            'data' => $partner
        ]);
    }

    public function update($request)
    {
        $partner = partner::find($request);

        if ($partner == null) {
            return view('spons.show', [
                'data' => []
            ]);
        }

        $validate_data = request()->validate([
            'name' => ['string', 'max:50', Rule::unique('partners')->ignore($request)],
            'promo' => ['string', 'max:50', 'nullable'],
            'description' => 'string|max:10000',
            'email' => ['string', 'email', 'max:50', Rule::unique('partners')->ignore($request),'nullable'],
            'website_link' => 'string|max:255|nullable',
        ]);

        $partner->update($validate_data);
        session()->flash('success', 'Partenaire modifié avec succès !');

        return redirect('/spons/' . $request . '/edit');
    }

    public function create()
    {
        return view('spons.create');
    }

    public function store()
    {
        $validate_data = request()->validate([
            'name' => ['required','string', 'max:50', Rule::unique('partners')],
            'promo' => ['string', 'max:50', Rule::unique('partners'), 'nullable'],
            'description' => ['string', 'max:10000', 'nullable'],
            'email' => ['string', 'email', 'max:50', Rule::unique('partners'), 'nullable'],
            'website_link' => 'string|max:255|nullable',
        ]);

        $partner = partner::create($validate_data, ['except' => ['logo']]);

        if (request()->hasFile('logo')) {
            $logo = request()->file('logo');
            $name = $partner->id . '_' . time() . '_' . $partner->name . '_' . random_int(0, 1000) . '.' . $logo->getClientOriginalExtension();

            $logo->storeAs('public/images/partner_logo', $name);

            $partner->logo()->create([
                'name' => $name,
                'path' => asset('storage/images/partner_logo/' . $name),
                'size' => $logo->getSize()
            ]);
        }

        session()->flash('success', 'Partenaire ajouté avec succès !');

        return redirect()->route('spons.index');
    }

    public function delete($request){

        $partner = partner::find($request);
        if ($partner == null) {
            return view('spons.show', [
                'data' => []
            ]);
        }

        $partner->delete();

        session()->flash('success', $partner->name . ' supprimé avec succès !');

        return redirect()->route('spons.index');
    }
}

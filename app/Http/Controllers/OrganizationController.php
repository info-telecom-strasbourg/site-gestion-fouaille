<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\OrganizationMember;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrganizationController extends Controller{
    public function index(){

        request()->validate([
            'order_by' => 'string|in:name,email,association',
            'order_direction' => 'string|in:asc,desc',
            'search' => 'string'
        ]);

        if (isset(request()->order_by)) {
            $order_by = request()->order_by;
        } else {
            $order_by = 'association';
            request()->merge([
                'order_by' => 'association'
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

        $organizations = Organization::order($order_by, $order_direction)
            ->filter(request(['search']))
            ->paginate(10)->withQueryString();

        if ($organizations == null) {
            return view('asso.index', [
                'data' => []
            ]);
        }

        $datas = $organizations->map(function ($organization) {
            return [
                'id' => $organization->id,
                'name' => [
                    'name' => $organization->name,
                    'redirect_route' => route('asso.show', $organization->id)
                ],
                'logo' => '<img src="'. $organization->logo->path .'" alt="Logo" class="img-fluid" style="max-width: 100px;">',
                'email' => $organization->email,
                'association' => $organization->association == 1 ? '<span class="badge badge-success">Oui</span>' : '<span class="badge badge-danger">Non</span>',
            ];
        });


        return view('asso.index', [
            'data' => $datas,
            'pagination' => $organizations->links()
        ]);
    }

    public function show($request){

        $organization = Organization::find($request);

        if ($organization == null) {
            return view('asso.show', [
                'data' => []
            ]);
        }

        $organization_members = $organization->members;

        return view('asso.show', [
            'data' => [
                'id' => $organization->id,
                'name' => $organization->name,
                'short_name' => $organization->short_name,
                'description' => $organization->description,
                'logo' => $organization->logo->path,
                'email' => $organization->email,
                'website_link' => $organization->website_link,
                'association' => $organization->association == 1 ? '<span class="badge badge-success">Oui</span>' : '<span class="badge badge-danger">Non</span>',
                'facebook_link' => $organization->facebook_link,
                'twitter_link' => $organization->twitter_link,
                'instagram_link' => $organization->instagram_link,
                'discord_link' => $organization->discord_link,
                'members' => $organization_members->map(function ($organization_member) {
                    return [
                        'id' => $organization_member->id,
                        'name' => [
                            'name' => $organization_member->last_name . ' ' . $organization_member->first_name,
                            'redirect_route' => route('member.show', $organization_member->id)
                        ],
                        'role' => $organization_member->pivot->role,
                    ];
                }),
            ]
        ]);
    }

    public function edit($request)
    {
        $organization = Organization::find($request);
        if ($organization == null) {
            return view('asso.edit', [
                'data' => []
            ]);
        }

        return view('asso.edit', [
            'data' => $organization
        ]);
    }

    public function update($request)
    {
        $organization = Organization::find($request);

        if ($organization == null) {
            return view('asso.show', [
                'data' => []
            ]);
        }

        $validate_data = request()->validate([
            'name' => ['string', 'max:50', Rule::unique('organizations')->ignore($request)],
            'short_name' => ['string', 'max:50', Rule::unique('organizations')->ignore($request)],
            'description' => 'string|max:10000',
            'email' => ['string', 'email', 'max:50', Rule::unique('organizations')->ignore($request)],
            'website_link' => 'string|max:255',
            'association' => 'in:on,off',
            'facebook_link' => 'string|max:255',
            'twitter_link' => 'string|max:255',
            'instagram_link' => 'string|max:255',
            'discord_link' => 'string|max:255',
        ]);

        if(array_key_exists('association', $validate_data)){
            $validate_data['association'] = 1;
        }else{
            $validate_data['association'] = 0;
        }

        $organization->update($validate_data);
        session()->flash('success', 'Asso/club modifiée avec succès !');

        return redirect('/asso/' . $request . '/edit');
    }

    public function create()
    {
        return view('asso.create');
    }

    public function store()
    {
        $validate_data = request()->validate([
            'name' => ['required','string', 'max:50', Rule::unique('organizations')],
            'short_name' => ['string', 'max:50', Rule::unique('organizations'), 'nullable'],
            'description' => ['string', 'max:10000', 'nullable'],
            'email' => ['string', 'email', 'max:50', Rule::unique('organizations'), 'nullable'],
            'website_link' => 'string|max:255|nullable',
            'association' => 'in:on,off|nullable',
            'facebook_link' => 'string|max:255|nullable',
            'twitter_link' => 'string|max:255|nullable',
            'instagram_link' => 'string|max:255|nullable',
            'discord_link' => 'string|max:255|nullable',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);

        if(array_key_exists('association', $validate_data)){
            $validate_data['association'] = 1;
        }else{
            $validate_data['association'] = 0;
        }

        $organization = Organization::create($validate_data, ['except' => ['logo']]);

        if (request()->hasFile('logo')) {
            $logo = request()->file('logo');
            $name = $organization->id . '_' . time() . '_' . $organization->name . '_' . random_int(0, 1000) . '.' . $logo->getClientOriginalExtension();

            $logo->storeAs('public/images/organization_logo', $name);

            $organization->logo()->create([
                'name' => $name,
                'path' => asset('storage/images/organization_logo/' . $name),
                'size' => $logo->getSize()
            ]);
        }

        session()->flash('success', 'Asso/club ajoutée avec succès !');

        return redirect()->route('asso.index');
    }
}

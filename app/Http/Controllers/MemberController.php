<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// add carbon
use Carbon\Carbon;

class MemberController extends Controller
{
    public function index()
    {

        // get members ordered by last name
        $members = Member::orderBy('last_name')->filter(request(['search']))->paginate(30)->withQueryString();

        if ($members->isEmpty()) {
            return view('member.index', [
                'data' => [],
                'pagination' => []
            ]);
        }


        return view('member.index', [
            'data' => $members->map(function ($member) {
                return [
                    'Id' => $member->id,
                    'Nom' => $member->last_name . ' ' . $member->first_name,
                    'Email' => $member->email,
                    'Téléphone' => $member->phone,
                    'Solde' => $member->balance,
                    'Cotisant' => $member->contributor == 1 ? 'Oui' : 'Non',
                    'Promotion' => $member->class,
                ];
            }),
            'pagination' => $members->links()
        ]);
    }

    public function show($request)
    {
        $member = Member::find($request);

        if ($member == null) {
            return view('member.show', [
                'data' => []
            ]);
        }

        $datas = [
            'id' => $member->id,
            'last_name' => $member->last_name,
            'first_name' => $member->first_name,
            'card_number' => $member->card_number,
            'email' => $member->email,
            'phone' => $member->phone,
            'balance' => $member->balance,
            'contributor' => $member->contributor == 1 ? '<span class="text-success">Oui</span>' : '<span class="text-danger">Oui</span>',
            'class' => $member->class,
            'admin' => $member->admin == 1 ? '<span class="text-success">Oui</span>' : '<span class="text-danger">Oui</span>',
            'created_at' => Carbon::parse($member->created_at)->format('d/m/Y H:i:s'),
            'birth_date' => Carbon::parse($member->birth_date)->format('d/m/Y'),
            'sector' => $member->sector,
            'orders' => $member->orders->map(function ($order) {
                return [
                    'id' => $order->id,
                    'price' => $order->product == null ? '<p class="text-success">+ ' . $order->price . '€</p>' : '<p class="text-danger">' . $order->price . '€</p>',
                    'amount' => $order->amount,
                    'product' => $order->product == null ? 'rechargement' : $order->product->name,
                    'type' => $order->product == null ? 'rechargement' : $order->product->productType->type,
                    'date' => Carbon::parse($order->date)->format('d/m/Y H:i:s')
                ];
            })
        ];


        return view('member.show', [
            'data' => $datas
        ]);
    }

    public function edit($request)
    {
        $member = Member::find($request);

        if ($member == null) {
            return view('member.edit', [
                'data' => []
            ]);
        }

        return view('member.edit', [
            'data' => $member
        ]);
    }

    public function update($id)
    {
        $member = Member::find($id);

        if ($member == null) {
            return view('member.index', [
                'data' => []
            ]);
        }

        if(request()->has('card_number')) { // card_number can be "0094994" that is not an integer
            request()->merge(['card_number' => intval(request()->card_number)]);
        }


        $validateData = request()->validate([
            'last_name' => 'max:50|min:2',
            'first_name' => 'max:50|min:2',
            'email' => [
                'email',
                'unique:members,email,' . $id
            ],
            'card_number' => [
                'nullable',
                'integer',
                'unique:members,card_number,' . $id
            ],
            'phone' => [
                'nullable',
                'unique:members,phone,' . $id
            ],
            'contributor' => 'nullable|string',
            'admin' => 'nullable|string',
            'class' => 'nullable|integer',
            'birth_date' => 'nullable|date',
            'sector' => 'nullable|string',
            'balance' => 'nullable|numeric'
        ]);


        if (array_key_exists('contributor', $validateData)) {
            $validateData['contributor'] = 1;
        }else{
            $validateData['contributor'] = 0;
        }

        if (array_key_exists('admin', $validateData)) {
            $validateData['admin'] = 1;
        }else{
            $validateData['admin'] = 0;
        }


        $member->update($validateData);
        session()->flash('success', 'Membre modifié avec succès !');

        return redirect('/member/' . $id . '/edit');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'last_name' => 'required|max:50',
            'first_name' => 'required|max:50',
            'email' => 'required|email|unique:members',
            'card_number' => 'nullable|integer|unique:members',
            'phone' => [
                'nullable',
                'unique:members',
            ],
            'contributor' => 'integer',
            'class' => 'nullable|integer',
            'birth_date' => 'nullable|date',
            'sector' => 'nullable|string'
        ]);

        Member::create([
            'last_name' => $validateData['last_name'],
            'first_name' => $validateData['first_name'],
            'email' => $validateData['email'],
            'card_number' => $validateData['card_number'],
            'phone' => $validateData['phone_number'],
            'contributor' => array_key_exists('contributor', $validateData) ?
                $validateData['contributor'] ? 1 : 0 : 0,
            'class' => $validateData['class'],
            'birth_date' => $validateData['birth_date'],
            'sector' => $validateData['sector']
        ]);


        return back();
    }
}

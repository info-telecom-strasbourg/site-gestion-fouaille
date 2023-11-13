<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MemberController extends Controller
{
    public function index()
    {

        request()->validate([
            'order_by' => 'string|in:name,email,phone,card_number,contributor,balance',
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

        $members = Member::order($order_by, $order_direction)
            ->filter(request(['search']))
            ->paginate(30)->withQueryString();

        if ($members->isEmpty()) {
            return view('member.index', [
                'data' => [],
                'pagination' => []
            ]);
        }


        return view('member.index', [
            'data' => $members->map(function ($member) {
                return [
                    'id' => $member->id,
                    'name' => [
                        'name' => $member->last_name . ' ' . $member->first_name,
                        'redirect_route' => route('member.show', $member->id)
                        ],
                    'email' => $member->email,
                    'phone' => $member->phone,
                    'balance' => $member->balance,
                    'contributor' => $member->contributor == 1 ? '<span class="badge badge-success">Oui</span>' : '<span class="badge badge-danger">Non</span>',
                ];
            }),
            'pagination' => $members->links()
        ]);
    }

    public function show($request)
    {

        request()->validate([
            'order_by' => 'string|in:price,amount,product,type,date',
            'order_direction' => 'string|in:asc,desc',
            'search' => 'string'
        ]);

        if (isset(request()->order_by)) {
            $order_by = request()->order_by;
        } else {
            $order_by = 'date';
            request()->merge([
                'order_by' => 'date'
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

        $member = Member::find($request);

        if ($member == null) {
            return view('member.show', [
                'data' => []
            ]);
        }

        $orders = $member->orders()
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('product_types', 'products.product_type_id', '=', 'product_types.id')
            ->order($order_by, $order_direction)
            ->filter(request(['search']))
            ->paginate(30)->withQueryString();

        return view('member.show', [
            'data' => [
                'id' => $member->id,
                'last_name' => $member->last_name,
                'first_name' => $member->first_name,
                'card_number' => $member->card_number,
                'email' => $member->email,
                'phone' => $member->phone,
                'balance' => $member->balance,
                'contributor' => $member->contributor == 1 ? '<span class="badge badge-success">Oui</span>' : '<span class="badge badge-danger">Non</span>',
                'class' => $member->class,
                'admin' => $member->admin == 1 ? '<span class="badge badge-success">Oui</span>' : '<span class="badge badge-danger">Non</span>',
                'created_at' => Carbon::parse($member->created_at)->format('d/m/Y H:i:s'),
                'birth_date' => Carbon::parse($member->birth_date)->format('d/m/Y'),
                'sector' => $member->sector,
                'orders' => $orders->map(function ($order) {
                    return [
                        'price' => $order->product == null ? '<p class="text-success">+ ' . $order->price . '€</p>' : '<p class="text-danger">' . $order->price . '€</p>',
                        'amount' => $order->amount,
                        'product' => $order->product == null ? 'rechargement' : $order->product->name,
                        'type' => $order->product == null ? 'rechargement' : $order->product->productType->type,
                        'date' => Carbon::parse($order->date)->format('d/m/Y H:i')
                    ];
                })
            ],
            'pagination' => $orders->links()

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

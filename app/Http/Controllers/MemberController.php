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
            'contributor' => $member->contributor == 1 ? 'Oui' : 'Non',
            'class' => $member->class,
            'admin' => $member->admin == 1 ? 'Oui' : 'Non',
            'created_at' => Carbon::parse($member->created_at)->format('d/m/Y H:i:s'),
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


        $validateData = request()->validate([
            'last_name' => 'max:50',
            'first_name' => 'max:50',
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
            'contributor' => 'string',
            'admin' => 'string',
            'class' => 'nullable|integer',
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
        ]);


        return back();
    }

    public function getData(Request $request)
    {
        $date_start = $request->input('datestart');
        $date_end = $request->input('dateend');

        $date_start = date('Y-m-d H:i:s', strtotime($date_start));
        $date_end = date('Y-m-d H:i:s', strtotime($date_end));

        $peoples = DB::select('SELECT Membre.nom, Membre.prenom, Order.prix, Order.type_produit,
                                    Order.produit, Order.date, Order.amount
                                FROM Membre
                                INNER JOIN Order
                                ON Membre.id = Order.id_membre
                                WHERE Order.date > ?
                                AND Order.date < ?', [$date_start, $date_end]);
        $total_commandes = DB::select('SELECT SUM(prix*amount) AS total
                                        FROM Order
                                        WHERE date > ?
                                        AND date < ?', [$date_start, $date_end]);
        $total_repas = DB::select('SELECT SUM(prix*amount) AS total
                                    FROM Order
                                    WHERE date > ?
                                    AND date < ?
                                    AND type_produit = "repas"', [$date_start, $date_end]);
        $total_boisson = DB::select('SELECT SUM(amount) AS total
                                    FROM Order
                                    WHERE date > ?
                                    AND date < ?
                                    AND type_produit = "boisson"', [$date_start, $date_end]);
        $date_start = date('Y-m-d\TH:i', strtotime($date_start));
        $date_end = date('Y-m-d\TH:i', strtotime($date_end));
        return view('index')->with('peoples', $peoples)
                            ->with('current_date1', $date_start)
                            ->with('current_date2', $date_end)
                            ->with('total_commandes', $total_commandes[0]->total)
                            ->with('total_repas', $total_repas[0]->total)
                            ->with('total_boisson', $total_boisson[0]->total);
    }
}

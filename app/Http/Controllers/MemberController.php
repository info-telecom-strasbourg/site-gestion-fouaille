<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// add carbon
use Carbon\Carbon;

class MemberController extends Controller
{
    public function index()
    {
        // get members ordered by last name
        $members = Member::orderBy('last_name')->paginate(30);


        return view('member.index', [
            'data' => $members->map(function ($member) {
                return [
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
                'regex:/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/' // regex for phone number
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

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
        return view('members.index', [
            'members' => Member::latest('created_at')->paginate(50)->withQueryString(),
        ]);
    }

    public function getData(Request $request)
    {
        $date_start = $request->input('datestart');
        $date_end = $request->input('dateend');

        $date_start = date('Y-m-d H:i:s', strtotime($date_start));
        $date_end = date('Y-m-d H:i:s', strtotime($date_end));

        $peoples = DB::select('SELECT Membre.nom, Membre.prenom, Commande.prix, Commande.type_produit,
                                    Commande.produit, Commande.date, Commande.amount
                                FROM Membre
                                INNER JOIN Commande
                                ON Membre.id = Commande.id_membre
                                WHERE Commande.date > ?
                                AND Commande.date < ?', [$date_start, $date_end]);
        $total_commandes = DB::select('SELECT SUM(prix*amount) AS total
                                        FROM Commande
                                        WHERE date > ?
                                        AND date < ?', [$date_start, $date_end]);
        $total_repas = DB::select('SELECT SUM(prix*amount) AS total
                                    FROM Commande
                                    WHERE date > ?
                                    AND date < ?
                                    AND type_produit = "repas"', [$date_start, $date_end]);
        $total_boisson = DB::select('SELECT SUM(amount) AS total
                                    FROM Commande
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

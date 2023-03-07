<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MembreController extends Controller
{
    public function index()
    {
        $membres = DB::select('SELECT * FROM Membre');
        return view('base')->with('membres',$membres);
    }
}

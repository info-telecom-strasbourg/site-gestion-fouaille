<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembreController extends Controller
{
    public function index()
    {
        $users = ["user1", "user2", "user3"];
        return view('base')->with('users', $users);
    }
}

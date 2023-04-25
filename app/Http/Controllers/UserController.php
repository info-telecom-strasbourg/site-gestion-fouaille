<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // CAS Login
    public function login(Request $request)
    {
        if(!cas()->checkAuthentication())
        {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            }
            cas()->authenticate();
        }
        $request->session()->put('cas_user', cas()->user());
        return redirect()->route('home');
    }

    public function logout()
    {
        session()->forget('cas_user');
        cas()->logout();
        // next lines will not be reached, check cas.php config file to see
        // where logout redirection is configured
    }

    public function checkIfUserIsConnected()
    {
        if(!cas()->isAuthenticated())
        {
            session()->forget('cas_user');
        }
        return view('home');
    }
}

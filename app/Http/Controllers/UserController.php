<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function authorized(string $name) : bool
    {
        $white_list = explode(',', env('CAS_WHITE_LIST'));
        return in_array($name, $white_list);
    }

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


        if($this->authorized(cas()->user()))
        {
            $request->session()->put([
                'cas_user' => cas()->user(),
                'message' => 'Vous êtes connecté à l\'application.',
                'failed' => false
            ]);
        }
        else
        {
            session()->put([
                'message' => 'Vous n\'êtes pas autorisé à vous connecter à cette application.',
                'failed' => true
            ]);
            cas()->logout(null, route('home'));
        }
        return redirect()->route('home');
    }

    public function logout()
    {
        session()->flush();
        cas()->logout();
        // next lines will not be reached, check cas.php config file to see
        // where logout redirection is configured
    }

    public function checkIfUserIsConnected(Request $request)
    {
        if(!cas()->isAuthenticated())
        {
            if($request->input('failed_login'))
            {
                session()->put('message', 'Vous n\'êtes pas autorisé à vous connecter à cette application.');
            }
            session()->forget('cas_user');
        }
        return view('home');
    }


}

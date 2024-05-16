<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ApiMemberController extends Controller
{
    public function index($name){

        $member = DB::table('members')
            ->Select('first_name', 'balance')
            ->Where('first_name', 'like', '%'.$name.'%')
            ->get();

        return response()->json(
            [
                'data' => $member->map(function ($member) {
                    return [
                        'name' => $member->first_name,
                        'balance' => $member->balance,
                    ];
                })
            ], 200
        )->setEncodingOptions(JSON_PRETTY_PRINT);
    }
}

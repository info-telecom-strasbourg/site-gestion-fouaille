<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ApiOrderController extends Controller
{
    public function index(){

        $name = "";

        $member = $product_details = DB::table('members')
            ->select('members.first_name', 'members.balance')
            ->where('members.first_name', '=', $name)
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

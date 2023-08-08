<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\Member;

class ApiChallengeController extends Controller
{
    public function index()
    {
        return response()->json(
            [
            'data' => Challenge::all()->map(function ($challenge) {
                    return [
                        'id' => $challenge->id,
                        'name' => $challenge->name,
                        'points' => $challenge->points,
                        'description' => $challenge->description,
                    ];
                })
            ]
        )->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function show($id)
    {
        $challenge = Challenge::find($id);

        if($challenge == null)
            return response()->json(
                [
                    'message' => 'Challenge not found'
                ], 404
            )->setEncodingOptions(JSON_PRETTY_PRINT);

        return response()->json(
            [
                'data' => [
                    'id' => $challenge->id,
                    'name' => $challenge->name,
                    'points' => $challenge->points,
                    'description' => $challenge->description,
                ]
            ], 200
        )->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    public function member_details($id)
    {
        $member = Member::find($id);

        if ($member == null)
            return response()->json(
                [
                    'message' => 'Member not found'
                ], 404
            )->setEncodingOptions(JSON_PRETTY_PRINT);


        $details = $member->challenges()->get()->map(function ($challenge) {
            return [
                'id' => $challenge->id,
                'name' => $challenge->name,
                'description' => $challenge->description,
                'points' => $challenge->points,
            ];
        });

        if ($details->isEmpty())
            return response()->json(
                [
                    'message' => 'No challenges found for this member'
                ], 404
            )->setEncodingOptions(JSON_PRETTY_PRINT);

        return response()->json(
            [
                'data' => [
                    'challenges' => $details,
                    'total_points' => $member->challenges()->sum('points'),
                ]
            ], 200
        )->setEncodingOptions(JSON_PRETTY_PRINT);

    }
}

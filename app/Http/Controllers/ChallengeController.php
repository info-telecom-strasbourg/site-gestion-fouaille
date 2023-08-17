<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index()
    {
        // all members that have done at least one challenge
        $members = Member::orderBy('last_name')->filter(request(['search']))->paginate(10);

        if ($members == null) {
            return view('challenge.index', [
                'data' => []
            ]);
        }

        $data = $members->map(function ($member, $challenge_count) {
            return [
                'member' => [
                    'Id' => $member->id,
                    'Nom' => $member->first_name . ' ' . $member->last_name,
                    'Points' => $member->challenges()->sum('points'),
                ],
                'challenges' => $member->challenges->map(function ($challenge) {
                    return [
                        'Nom' => $challenge->name,
                        'Date de réalisation' => Carbon::parse($challenge->pivot->realized_at)->format('d/m/Y H:i:s'),
                    ];
                })->toArray(),
                'challenge_count' => $member->challenges->where('pivot.realized_at', '!=', null)->count(),
            ];
        });


        return view('challenge.index', [
            'data' => $data,
            'participation_count' => Member::has('challenges')->count(),
            'pagination' => $members->links()
        ]);
    }

    public function show($id){
        $member = Member::find($id);

        if ($member == null) {
            return view('challenge.show', [
                'data' => []
            ]);
        }

        $data = [
            'user_name' => $member->last_name . ' ' . $member->first_name,
            'id' => $member->id,
            'challenges' => Challenge::all()->map(function ($challenge) use ($member) {
                return $member->challenges->where('id', $challenge->id)->first() != null ? [
                    'id' => $challenge->id,
                    'name' => $challenge->name,
                    'points' => $challenge->points,
                    'realized_at' => Carbon::parse($member->challenges->where('id', $challenge->id)->first()->pivot->realized_at)->format('d/m/Y H:i:s'),
                ] : [
                    'id' => $challenge->id,
                    'name' => $challenge->name,
                    'points' => $challenge->points,
                    'realized_at' => null,
                ];
            }),
        ];

        return view('challenge.show', [
            'data' => $data,
            'total_points' => $member->challenges()->sum('points'),
            'total_challenges' => $member->challenges->where('pivot.realized_at', '!=', null)->count(),
        ]);
    }

    public function create($id)
    {
        $member = Member::find($id);

        if ($member == null) {
            return view('challenge.show', [
                'data' => []
            ]);
        }

        $challenge = Challenge::find(request('challenge_id'));

        if ($challenge == null) {
            return view('challenge.show', [
                'data' => []
            ]);
        }

        $member->challenges()->attach($challenge->id, ['realized_at' => Carbon::now()]);

        return redirect()->route('challenge.show', $member->id);
    }

    public function destroy($id)
    {
        $member = Member::find($id);

        if ($member == null) {
            return view('challenge.show', [
                'data' => []
            ]);
        }

        $challenge = Challenge::find(request('challenge_id'));

        if ($challenge == null) {
            return view('challenge.show', [
                'data' => []
            ]);
        }

        $member->challenges()->detach($challenge->id);

        return redirect()->route('challenge.show', $member->id);
    }
}

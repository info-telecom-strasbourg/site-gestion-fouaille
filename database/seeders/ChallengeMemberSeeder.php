<?php

namespace Database\Seeders;

use App\Models\Challenge;
use App\Models\ChallengeMember;
use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChallengeMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = Member::inRandomOrder()->limit(70)->get();
        $challenges = Challenge::all();

        foreach ($members as $member) {
            ChallengeMember::factory()->create([
                'member_id' => $member->id,
                'challenge_id' => $challenges->random()->id,
            ]);

            ChallengeMember::factory()->create([
                'member_id' => $member->id,
                'challenge_id' => $challenges->random()->id,
            ]);

            ChallengeMember::factory()->create([
                'member_id' => $member->id,
                'challenge_id' => $challenges->random()->id,
            ]);

            ChallengeMember::factory()->create([
                'member_id' => $member->id,
                'challenge_id' => $challenges->random()->id,
            ]);
        }


    }
}

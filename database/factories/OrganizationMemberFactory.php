<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrganizationMember>
 */
class OrganizationMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_organization' => Organization::inRandomOrder()->first()->id,
            'id_member' => Member::inRandomOrder()->first()->id,
            'role' => fake()->randomElement(['president', 'trésorier', 'secrétaire', 'spons', 'reseaux', 'extérieur']),
        ];
    }
}

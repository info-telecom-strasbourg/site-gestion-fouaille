<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'short_name' => $this->faker->unique()->word,
            'name' => $this->faker->unique()->company,
            'description' => $this->faker->text,
            'website_link' => $this->faker->url,
            'facebook_link' => $this->faker->url,
            'twitter_link' => $this->faker->url,
            'instagram_link' => $this->faker->url,
            'discord_link' => $this->faker->url,
            'association' => $this->faker->boolean,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}

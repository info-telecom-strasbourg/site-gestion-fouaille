<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'last_name' => fake()->lastName,
            'first_name' => fake()->firstName,
            'nickname' => fake()->userName,
            'card_number' => fake()->unique()->randomNumber(8),
            'email' => fake()->unique()->email,
            'phone_number' => fake()->unique()->phoneNumber,
            'balance' => fake()->randomFloat(2, 0, 100),
            'admin' => 1,
            'contributor' => 1,
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'class' => fake()->numberBetween(1, 10)
        ];
    }
}

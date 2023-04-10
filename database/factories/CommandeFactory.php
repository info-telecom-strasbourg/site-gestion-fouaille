<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commande>
 */
class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_product' => Product::InRandomOrder()->first()->id,
            'id_member' => Member::InRandomOrder()->first()->id,
            'price' => fake()->randomFloat(2, 0, 3),
            'amount' => fake()->numberBetween(1, 10),
            'date' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}

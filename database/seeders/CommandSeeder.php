<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Commande;
use Illuminate\Database\Seeder;

class CommandSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Commande::factory(1000)->create();
    }
}

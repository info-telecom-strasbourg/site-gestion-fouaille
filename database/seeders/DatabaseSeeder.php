<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Commande;
use App\Models\Member;
use App\Models\Organization;
use App\Models\OrganizationMember;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Member::factory(100)->create();

        ProductType::factory()->create([
            'type' => 'midi',
        ]);

        ProductType::factory()->create([
            'type' => 'soiree',
        ]);

        Product::factory()->create([
            'name' => 'pizza',
            'slug' => 'pizza',
            'price' => 2.5,
            'id_product_type' => ProductType::where('type', 'midi')->first()->id,
            'color' => '#ff0000'
        ]);

        Product::factory()->create([
            'name' => 'nouilles',
            'slug' => 'nouilles',
            'price' => 1,
            'id_product_type' => ProductType::where('type', 'midi')->first()->id,
            'color' => '#00ff00'
        ]);

        Product::factory()->create([
            'name' => 'meteor',
            'slug' => 'meteor',
            'price' => 1.2,
            'id_product_type' => ProductType::where('type', 'soiree')->first()->id,
            'color' => '#0000ff'
        ]);

        Product::factory()->create([
            'name' => 'kastel',
            'slug' => 'kastel',
            'price' => 3,
            'id_product_type' => ProductType::where('type', 'soiree')->first()->id,
            'color' => '#ff00ff'
        ]);

        Product::factory()->create([
            'name' => 'primus',
            'slug' => 'primus',
            'price' => 1,
            'id_product_type' => ProductType::where('type', 'soiree')->first()->id,
            'color' => '#ffff00'
        ]);

        Commande::factory(1000)->create();

        Organization::factory()->create([
            'slug' => 'bde',
            'name' => 'Bureau des étudiants',
            'description' => 'Le BDE est l’association étudiante de l’ESIEE Paris.
            Il a pour mission de représenter les étudiants de l’école et de les aider dans leur vie étudiante.
            Il organise des événements, des soirées, des voyages, des activités sportives, des concours,
            des animations, des conférences, des ateliers, des formations, des rencontres, des sorties,
            des voyages, des visites',
            'website_link' => 'https://bde.esiee.fr',
            'facebook_link' => 'https://www.facebook.com/bdeesiee',
            'twitter_link' => 'https://twitter.com/bdeesiee',
            'instagram_link' => 'https://www.instagram.com/bdeesiee/',
            'discord_link' => 'https://discord.gg/8Q2Y4Y',
            'logo_link' => 'https://bde.esiee.fr/wp-content/uploads/2019/09/logo-bde.png',
            'association' => true,
        ]);

        Organization::factory()->create([
            'slug' => 'bds',
            'name' => 'Bureau des Sports',
            'description' => 'Le BDS est l’association sportive de l’ESIEE Paris.',
            'website_link' => 'https://bds.esiee.fr',
            'facebook_link' => 'https://www.facebook.com/bdsesiee',
            'twitter_link' => 'https://twitter.com/bdsesiee',
            'instagram_link' => 'https://www.instagram.com/bdsesiee/',
            'discord_link' => 'https://discord.gg/8Q2Y4Y',
            'logo_link' => 'https://bds.esiee.fr/wp-content/uploads/2019/09/logo-bds.png',
            'association' => true,
        ]);

        Organization::factory()->create([
            'slug' => 'bdf',
            'name' => 'Bureau des Fêtes',
            'description' => 'Le BDF est l’association de fête de l’ESIEE Paris.',
            'website_link' => 'https://bde.esiee.fr',
            'facebook_link' => 'https://www.facebook.com/bdeesiee',
            'twitter_link' => 'https://twitter.com/bdeesiee',
            'instagram_link' => 'https://www.instagram.com/bdeesiee/',
            'discord_link' => 'https://discord.gg/8Q2Y4Y',
            'logo_link' => 'https://bde.esiee.fr/wp-content/uploads/2019/09/logo-bde.png',
            'association' => true,
        ]);

        OrganizationMember::factory(100)->create();


    }
}

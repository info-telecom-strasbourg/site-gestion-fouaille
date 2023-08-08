<?php

namespace Database\Seeders;

use App\Models\Challenge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ChallengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Challenge::factory()->create([
            'name' => 'Sticker',
            'description' => '🌠Récupérer tous les stickers des listeux BDE de l\'année dernière',
            'points' => 2,
        ]);

        Challenge::factory()->create([
            'name' => 'Ecocup 1',
            'description' => '🥤Récupérer tous les ecocups des listeux BDE de l\'année dernière',
            'points' => 2,
        ]);

        Challenge::factory()->create([
            'name' => 'Dodo',
            'description' => '🏠Dormir dans au moins 3 collocations différentes',
            'points' => 3,
        ]);

        Challenge::factory()->create([
            'name' => 'Poussière',
            'description' => '🍺Battre à la poussière un membere du club poussières (N\'importe quelle liquide)',
            'points' => 2,
        ]);

        Challenge::factory()->create([
            'name' => 'Cantona',
            'description' => '🎵Lancer un champ dans le tram de l\'ambiance sans invoquer un Eric Cantona',
            'points' => 1,
        ]);

        Challenge::factory()->create([
            'name' => 'Tactique',
            'description' => '💤Apparaître sur la boite tactique',
            'points' => 1,
        ]);

        Challenge::factory()->create([
            'name' => 'Déguisement',
            'description' => '🥸Passer une soirée avec un déguisea du fouaille et le garder pendant le tram de l\'ambiance',
            'points' => 2,
        ]);

        Challenge::factory()->create([
            'name' => 'Pâte',
            'description' => '🍝Manger les pâtes de 6h du matin durant le WEI',
            'points' => 2,
        ]);

        Challenge::factory()->create([
            'name' => 'Survivant',
            'description' => '🎉Etre un survivant du WEI',
            'points' => 3,
        ]);

        Challenge::factory()->create([
            'name' => 'Ivrogne',
            'description' => '🍻Etre le meilleur consommateur de l\'intégration',
            'points' => 3,
        ]);

        Challenge::factory()->create([
            'name' => 'Europapark',
            'description' => '🎢Faire une photo à Europapark pendant un rollercoaster et faire TPS avec ses mains (3 personnes requises)',
            'points' => 2,
        ]);

        Challenge::factory()->create([
            'name' => 'Trader',
            'description' => '📈Etre le plus rentable à la soirée bourse',
            'points' => 3,
        ]);

        Challenge::factory()->create([
            'name' => 'Ecocup 2',
            'description' => '🥤Etre le premier à récuperer les écocups des listeux BDE d\'il y a deux ans',
            'points' => 3,
        ]);

        Challenge::factory()->create([
            'name' => 'Artiste',
            'description' => '🎤Participer à la scéne libre au fouaille pendant une soirée oeno',
            'points' => 2,
        ]);

        Challenge::factory()->create([
            'name' => 'Fouzy',
            'description' => '🐦Prendre un selfie avec fouzy et fouzette',
            'points' => 1,
        ]);

        Challenge::factory()->create([
            'name' => 'Afterwork',
            'description' => '🏆Gagner un afterwork',
            'points' => 1,
        ]);

        Challenge::factory()->create([
            'name' => 'Canapé',
            'description' => '🛋Etre assis sur le petit canapé noir à 18h48 le 29/09',
            'points' => 1,
        ]);

        Challenge::factory()->create([
            'name' => 'After',
            'description' => '🪩Aller en after fouaille au rallye des collocs',
            'points' => 3,
        ]);

        Challenge::factory()->create([
            'name' => 'Soirée TPS',
            'description' => '🎊Apparaître sur moi en soirée à TPS',
            'points' => 1,
        ]);

        Challenge::factory()->create([
            'name' => 'Couple TPS',
            'description' => '💋Apparaître sur moi et les couples à TPS/BS',
            'points' => 1,
        ]);

        Challenge::factory()->create([
            'name' => 'Lan',
            'description' => '🎮Gagner un tournoi à la LAN d\'ITS',
            'points' => 2,
        ]);

        Challenge::factory()->create([
            'name' => 'Schnaps',
            'description' => '🥾Aller à la rando schnaps après la PF',
            'points' => 1,
        ]);
    }
}

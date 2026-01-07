<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $categories = [
            // Homme (nouvelles)
            ['nom' => 'Costumes', 'sexe' => 'homme'],
            ['nom' => 'Sweatshirts', 'sexe' => 'homme'],
            ['nom' => 'Shorts', 'sexe' => 'homme'],
            ['nom' => 'Chaussures', 'sexe' => 'homme'],
            ['nom' => 'Blazers', 'sexe' => 'homme'],
            ['nom' => 'Manteaux', 'sexe' => 'homme'],
    ['nom' => 'Pulls', 'sexe' => 'homme'],
    ['nom' => 'Chaussures de sport', 'sexe' => 'homme'],
    ['nom' => 'Survêtements', 'sexe' => 'homme'],
    ['nom' => 'Débardeurs', 'sexe' => 'homme'],
    ['nom' => 'Chapeaux', 'sexe' => 'homme'],
    ['nom' => 'Sandales', 'sexe' => 'homme'],
    ['nom' => 'Pantalons cargo', 'sexe' => 'homme'],
    ['nom' => 'Maillots de bain', 'sexe' => 'homme'],
    ['nom' => 'Baskets', 'sexe' => 'homme'],

            // Femme (nouvelles)
            ['nom' => 'Tops', 'sexe' => 'femme'],
            ['nom' => 'Tuniques', 'sexe' => 'femme'],
            ['nom' => 'Vestes', 'sexe' => 'femme'],
            ['nom' => 'Chaussures', 'sexe' => 'femme'],
            ['nom' => 'Accessoires', 'sexe' => 'femme'],
            ['nom' => 'Blouses', 'sexe' => 'femme'],
    ['nom' => 'Leggings', 'sexe' => 'femme'],
    ['nom' => 'Combinaisons', 'sexe' => 'femme'],
    ['nom' => 'Collants', 'sexe' => 'femme'],
    ['nom' => 'Gilets', 'sexe' => 'femme'],
    ['nom' => 'Maillots de bain', 'sexe' => 'femme'],
    ['nom' => 'Baskets', 'sexe' => 'femme'],
    ['nom' => 'Chapeaux', 'sexe' => 'femme'],
    ['nom' => 'Sandales', 'sexe' => 'femme'],
    ['nom' => 'Pyjamas', 'sexe' => 'femme'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['nom' => $cat['nom'], 'sexe' => $cat['sexe']]
            );
        }
    }
}

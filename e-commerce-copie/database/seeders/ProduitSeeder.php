<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Produit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->command->error('Aucune catégorie trouvée. Exécute d’abord le CategorySeeder.');
            return;
        }

        $produits = [
            ['T-shirt basique', 'Coton 100%', 99, 50],
            ['Jean slim', 'Jean bleu clair extensible', 249, 30],
            ['Chemise blanche', 'Manches longues, col classique', 179, 40],
            ['Veste légère', 'Idéale pour la mi-saison', 299, 25],
            ['Pantalon cargo', 'Multipoches, confortable', 199, 20],
            ['Pull col roulé', 'Parfait pour l’hiver', 159, 35],
            ['Blouse imprimée', 'Motifs floraux, manches bouffantes', 139, 45],
            ['Robe midi', 'Élégante et fluide', 229, 30],
            ['Jupe plissée', 'Style chic, taille haute', 149, 50],
            ['Top satiné', 'Effet brillant, bretelles fines', 99, 40],
            ['Jean mom', 'Coupe ample, taille haute', 189, 30],
            ['Veste en jean', 'Style décontracté', 259, 20],
            ['Sweat oversize', 'Confort et style urbain', 129, 50],
            ['Tunique longue', 'Tissu fluide et léger', 159, 25],
            ['Débardeur basique', 'Idéal pour l’été', 79, 60],
            ['Combinaison chic', 'Parfaite pour les soirées', 279, 15],
            ['Short en lin', 'Tissu respirant', 109, 35],
            ['Gilet long', 'Style casual chic', 179, 30],
            ['Maillot 1 pièce', 'Forme classique', 199, 25],
            ['Chaussures basses', 'Confortables au quotidien', 219, 40],
        ];

        foreach ($produits as [$nom, $desc, $prix, $stock]) {
            $categorie = $categories->random();
            Produit::create([
                'nom' => $nom,
                'description' => $desc,
                'prix' => $prix,
                'stock' => $stock,
                'categorie_id' => $categorie->id,
            ]);
        }
    }
}

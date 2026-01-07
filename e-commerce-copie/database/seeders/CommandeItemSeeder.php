<?php

namespace Database\Seeders;

use App\Models\Commande;
use App\Models\Commande_Item;
use App\Models\Produit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommandeItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        for ($i = 1; $i <= 200; $i++) {
            DB::table('commande__items')->insert([
                'commande_id' => rand(5232, 5730),      // Assure-toi que les commandes 1 à 20 existent
                'produit_id' => rand(21, 48),       // Assure-toi que les produits 1 à 50 existent
                'quantite' => rand(1, 5),
                'prix_unitaire' => rand(10, 200) + 0.99, // Prix aléatoire avec centimes
                'product_color_id' => rand(1, 7), // nullable, mais ici on met un id existant, ou null si tu préfères
                'product_size_id' => rand(1, 4),   // nullable aussi
                'created_at' => '2025-01-11 18:24:20',
                'updated_at' => '2025-01-11 18:24:20',
            ]);
        }
    }
}

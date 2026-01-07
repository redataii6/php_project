<?php

namespace Database\Seeders;

use App\Models\ProductImage;
use App\Models\Produit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProduitImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $produits = Produit::whereBetween('id', [44, 48])->get();
        foreach ($produits as $produit) {
            ProductImage::create([
                'produit_id' => $produit->id,
                'image_path' => 'produits/mqlolY7WAkazPcjx35F1oqGB9iwrUYJKbSjQWnAD.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

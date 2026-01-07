<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Appelle ici les autres seeders
        $this->call([
            // UserSeeder::class,
            // CommandeSeeder::class,
            CommandeItemSeeder::class,
            // CategorieSeeder::class,
            // ProduitSeeder::class,
            // ProduitImageSeeder::class,
        ]);
    }
}

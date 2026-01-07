<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Panier;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitsController extends Controller
{
    //
    public function index(Request $request, $id = null)
    {
        $query = Produit::with('firstPhoto');

        // Si un ID de catégorie est passé, on filtre par catégorie
        if ($id !== null) {
            $query->where('categorie_id', $id);
            
        }

        $productIds = $query->pluck('id');

        $couleurs = ProductColor::whereHas('variantes', function ($q) use ($productIds) {
            $q->whereIn('produit_id', $productIds);
        })->get();

        // Filtres dynamiques
        $filters = [];

        if ($request->has('f.taille')) {
            $tailleIds = $request->input('f.taille'); // [1, 2, 3] => ce sont les IDs

            $query->whereHas('variantes', function ($q) use ($tailleIds) {
                $q->whereIn('size_id', $tailleIds);
            });
        }
        if ($request->has('f.couleur')) {
            $couleurIds = $request->input('f.couleur'); // tableau d'IDs des couleurs sélectionnées

            $query->whereHas('variantes', function ($q) use ($couleurIds) {
                $q->whereIn('color_id', $couleurIds);  // ou 'couleur_id' selon ta colonne
            });
        }


        if ($request->filled('f.prix_min') || $request->filled('f.prix_max')) {
            $min = $request->input('f.prix_min', 0);
            $max = $request->input('f.prix_max', 999999);

            if ($request->filled('f.prix_min') && $request->filled('f.prix_max')) {
                // Les deux sont remplis => utiliser between
                $filters[] = [
                    'column' => 'prix',
                    'operator' => 'between',
                    'query_1' => $min,
                    'query_2' => $max,
                    'match' => 'and'
                ];
            } elseif ($request->filled('f.prix_min')) {
                // Seulement le min => utiliser greaterThan ou >=
                $filters[] = [
                    'column' => 'prix',
                    'operator' => 'greaterThanOrEqualTo',
                    'query_1' => $min,
                    'match' => 'and'
                ];
            } elseif ($request->filled('f.prix_max')) {
                // Seulement le max => utiliser lessThan ou <=
                $filters[] = [
                    'column' => 'prix',
                    'operator' => 'lessThan',
                    'query_1' => $max,
                    'match' => 'and'
                ];
            }
        }

        $customBuilder = new \App\Support\CustomQueryBuilder();
        $customBuilder->apply($query, ['f' => $filters]);

        $products = $query->get();

        $tailles = ProductSize::all();
        $categoriesFemme = \App\Models\Category::where('sexe', 'femme')->get();
        $categoriesHomme = \App\Models\Category::where('sexe', 'homme')->get();
        $categorie = $id ? \App\Models\Category::find($id) : null;

        return view('produits', compact('categoriesFemme', 'categoriesHomme', 'categorie', 'products', 'tailles', 'couleurs'));
    }



    public function show($id)
    {

        $product = Produit::with(['images','variantes.couleur', 'variantes.taille'])->findOrFail($id);
        $product->quantite = 1; // Initialiser la quantité à 1


        $categoriesFemme = Category::where('sexe', 'femme')->get();
        $categoriesHomme = Category::where('sexe', 'homme')->get();

        $quantiteReservee = Panier::where('produit_id', $product->id)
            ->where('reserved_until', '>', now())
            ->sum('quantite');
        $stockDisponible = $product->stock - $quantiteReservee;

        $suggested = Produit::where('categorie_id', $product->categorie_id)
            ->where('id', '!=', $product->id)
            ->with('firstPhoto')
            ->inRandomOrder()
            ->limit(5)
            ->get();



        return view('produit_details', compact('product', 'categoriesFemme', 'categoriesHomme', 'suggested', 'stockDisponible'));
    }

    
}

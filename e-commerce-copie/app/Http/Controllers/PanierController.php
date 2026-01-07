<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Commande;
use App\Models\Commande_Item;
use App\Models\Panier;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;

class PanierController extends Controller
{
    //
    public function index()
    {
        $user_id = Auth::id();
        $articles = Panier::where('user_id', $user_id)
            ->with('produit')
            ->with('productColor')
            ->with('productSize')
            ->get();

        $sousTotal = $articles->sum(function ($item) {
            return $item->produit->prix * $item->quantite;
        });
        $articles->each(function ($item) {
            $item->produit->image = $item->produit->images()->first();
        });

        if ($sousTotal == 0) {
            $livraison = 0;
        } else {
            $livraison = 20; // fixe ou dynamique selon ton besoin
        }
        $total = $sousTotal + $livraison;
        $categoriesFemme = Category::where('sexe', 'femme')->get();
        $categoriesHomme = Category::where('sexe', 'homme')->get();

        return view('panier', compact('categoriesFemme', 'categoriesHomme', 'articles', 'sousTotal', 'livraison', 'total'));
    }

    public function ajouter(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'product_color_id' => 'required|exists:product_colors,id',
            'product_size_id' => 'required|exists:product_sizes,id',
            'quantite' => 'required|integer|min:1',
        ]);

        $produit = Produit::findOrFail($request->produit_id);

        // Vérifier si le même produit avec la même taille et couleur est déjà dans le panier
        $panier = Panier::where('user_id', Auth::id())
            ->where('produit_id', $request->produit_id)
            ->where('product_color_id', $request->product_color_id)
            ->where('product_size_id', $request->product_size_id)
            ->first();

        // Calcul du stock disponible en excluant les réservations en cours
        $quantiteReservee = Panier::where('produit_id', $request->produit_id)
            ->where('product_color_id', $request->product_color_id)
            ->where('product_size_id', $request->product_size_id)
            ->where('reserved_until', '>', now())
            ->sum('quantite');

        $stockDisponible = $produit->stock - $quantiteReservee;

        if ($request->quantite > $stockDisponible) {
            return redirect()->back()->with('error', 'Stock insuffisant. Il reste seulement ' . $stockDisponible . ' en stock.');
        }

        if ($panier) {
            $panier->increment('quantite', $request->quantite);
        } else {
            Panier::create([
                'user_id' => Auth::id(),
                'produit_id' => $request->produit_id,
                'product_color_id' => $request->product_color_id,
                'product_size_id' => $request->product_size_id,
                'quantite' => $request->quantite,
                'reserved_until' => now()->addMinutes(30),
            ]);
        }

        return redirect()->route('panier.index')->with('success', 'Produit ajouté au panier.');
    }


    public function incrementer($id)
    {
        $article = Panier::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // On récupère le produit lié à cet article
        $produit = Produit::findOrFail($article->produit_id);

        // Vérification du stock
        if ($article->quantite >= $produit->stock) {
            return redirect()->back()->with('error', 'Stock insuffisant pour ajouter plus.');
        }

        $article->increment('quantite');

        return redirect()->route('panier.index')->with('success', 'Quantité augmentée.');
    }

    // Décrémenter la quantité
    public function decrementer($id)
    {
        $article = Panier::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($article->quantite > 1) {
            $article->decrement('quantite');
        } 

        return redirect()->route('panier.index')->with('success', 'Quantité diminuée.');
    }


    // 3. Supprimer un produit du panier
    public function supprimer($id)
    {
        $article = Panier::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $article->delete();

        return redirect()->route('panier.index')->with('success', 'Produit supprimé du panier.');
    }



    public function commande()
    {
        $user_id = Auth::id();
        $articles = Panier::where('user_id', $user_id)->with('produit')->get();

        if ($articles->isEmpty()) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide.');
        }

        DB::beginTransaction();

        try {
            // 1. Créer la commande
            $commande = Commande::create([
                'user_id' => $user_id,
                'total' => 0, // initialement 0
                'statut' => 'en attente',
            ]);

            // 2. Ajouter les produits du panier comme commande_items
            foreach ($articles as $article) {
                Commande_Item::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $article->produit_id,
                    'quantite' => $article->quantite,
                    'prix_unitaire' => $article->produit->prix,
                ]);
            }

            // 3. Recalculer automatiquement le total de la commande
            $commande->calculerTotal();

            // 4. Vider le panier
            Panier::where('user_id', $user_id)->delete();

            DB::commit();

            return redirect()->route('panier.index', $commande->id)
                ->with('success', 'Commande validée avec succès !');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('panier.index')
                ->with('error', 'Erreur lors de la validation de la commande : ' . $e->getMessage());
        }
    }
}

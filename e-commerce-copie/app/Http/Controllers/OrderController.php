<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Commande;
use App\Models\Commande_Item;
use App\Models\Panier;
use App\Models\ProduitVariante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class OrderController extends Controller
{
    //
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email',
            'tel' => 'required|string',
            'adresse' => 'required|string',
            'ville' => 'required|string',
            'payment' => 'required|in:card,delivery',
        ]);

        $user_id = Auth::id();
        $articles = Panier::where('user_id', $user_id)->with('produit')->get();

        if ($articles->isEmpty()) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide.');
        }

        foreach ($articles as $article) {
            if ($article->quantite > $article->produit->stock) {
                return redirect()->route('panier.index')
                    ->with('error', 'Stock insuffisant pour le produit ' . $article->produit->nom);
            }
        }


        // Paiement à la livraison
        if ($data['payment'] === 'delivery') {
            DB::beginTransaction();

            try {
                $commande = Commande::create([
                    'user_id' => $user_id,
                    'nom' => $data['nom'],
                    'prenom' => $data['prenom'],
                    'email' => $data['email'],
                    'tel' => $data['tel'],
                    'adresse' => $data['adresse'],
                    'ville' => $data['ville'],
                    'statut' => 'en attente',
                    'total' => 0,
                    'methode_paiement' => 'delivery',
                ]);

                foreach ($articles as $article) {
                    Commande_Item::create([
                        'commande_id' => $commande->id,
                        'produit_id' => $article->produit_id,
                        'quantite' => $article->quantite,
                        'prix_unitaire' => $article->produit->prix,
                        'product_color_id' => $article->product_color_id,
                        'product_size_id' => $article->product_size_id,
                    ]);

                    $variation = ProduitVariante::where('produit_id', $article->produit_id)
                        ->where('color_id', $article->product_color_id)
                        ->where('size_id', $article->product_size_id)
                        ->first();
                    $article->produit->stock -= $article->quantite;
                    $article->produit->save();
                    $variation->stock -= $article->quantite;
                    $variation->save();
                }

                $commande->calculerTotal();
                Panier::where('user_id', $user_id)->delete();

                DB::commit();

                return redirect()->route('panier.index')->with('success', 'Commande enregistrée avec paiement à la livraison.');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('panier.index')->with('error', 'Erreur : ' . $e->getMessage());
            }
        }

        // Paiement par carte via Stripe
        $total = $articles->sum(fn($item) => $item->produit->prix * $item->quantite);

        // Stocker les données utilisateur en session pour les récupérer après paiement
        session([
            'commande_infos' => $data
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'mad',
                    'product_data' => [
                        'name' => 'Commande Shiny',
                    ],
                    'unit_amount' => $total * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($session->url);
    }

    public function showOrders()
    {
        $userId = Auth::id();
        $categoriesFemme = Category::where('sexe', 'femme')->get();
        $categoriesHomme = Category::where('sexe', 'homme')->get();

        $commandes = Commande::where('user_id', $userId)
            ->with('commande_item.produit')
            ->orderByDesc('created_at')
            ->get();

        return view('client.commandes', compact('commandes', 'categoriesFemme', 'categoriesHomme'));
    }
}

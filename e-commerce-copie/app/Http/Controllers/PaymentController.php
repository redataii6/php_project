<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Commande_Item;
use App\Models\Order;
use App\Models\Panier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    //


    public function success()
    {
        $user_id = Auth::id();
        $articles = Panier::where('user_id', $user_id)->with('produit')->get();

        if ($articles->isEmpty()) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide.');
        }

        // Récupération des infos client depuis la session
        $data = session('commande_infos');

        if (!$data) {
            return redirect()->route('panier.index')->with('error', 'Données de commande manquantes.');
        }

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
                'statut' => 'payée',
                'total' => 0,
                'methode_paiement' => 'card',
            ]);

            foreach ($articles as $article) {
                Commande_Item::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $article->produit_id,
                    'quantite' => $article->quantite,
                    'prix_unitaire' => $article->produit->prix,
                ]);
                $article->produit->stock-=$article->quantite;
                $article->produit->save();
            }

            $commande->calculerTotal();
            Panier::where('user_id', $user_id)->delete();
            

            DB::commit();

            // Nettoyer la session
            session()->forget('commande_infos');

            return redirect()->route('panier.index')->with('success', 'Commande payée et enregistrée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('panier.index')->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    public function cancel()
    {
         return redirect()->route('panier.index')->with('error', 'Paiement annulé.');
    }
}

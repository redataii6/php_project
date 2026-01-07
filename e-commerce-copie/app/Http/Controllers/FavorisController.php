<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Produit;
use Illuminate\Http\Request;

class FavorisController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        $favoris = $user->favorites()->get();
        $categoriesFemme = Category::where('sexe', 'femme')->get();
        $categoriesHomme = Category::where('sexe', 'homme')->get();


        return view('favoris', compact('categoriesFemme', 'categoriesHomme', 'favoris'));
    }

    public function toggle(Produit $product)
    {
        $user = auth()->user();

        if ($user->favorites()->where('produit_id', $product->id)->exists()) {
            $user->favorites()->detach($product->id);
            return response()->json(['favori' => false]);
        } else {
            $user->favorites()->attach($product->id);
            return response()->json(['favori' => true]);
        }
    }

    public function remove(Produit $product)
    {
        $user = auth()->user();
        $user->favorites()->detach($product->id);
        return redirect()->back()->with('success', 'Produit retiré des favoris.');
    }
}

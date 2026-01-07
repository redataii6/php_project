<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Message;
use App\Models\Produit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $categoriesFemme = Category::where('sexe', 'femme')->get();
        $categoriesHomme = Category::where('sexe', 'homme')->get();
        $messages = Message::where('visible', 1)->get();

        $topHommes = Produit::withCount('commande__items as total_vendus')
            ->whereHas('category', function ($q) {
                $q->where('sexe', 'homme');
            })
            ->with('firstPhoto')
            ->orderByDesc('total_vendus')
            ->limit(4)
            ->get();

        $topFemmes = Produit::withCount('commande__items as total_vendus')
            ->whereHas('category', function ($q) {
                $q->where('sexe', 'femme');
            })
            ->with('firstPhoto')
            ->orderByDesc('total_vendus')
            ->limit(4)
            ->get();

        return view('welcome', compact('categoriesFemme', 'categoriesHomme', 'messages', 'topHommes', 'topFemmes'));
    }
}

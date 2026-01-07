<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AidePagesController extends Controller
{
    //
    public function loadCategories()
    {
        return [
            'categoriesFemme' => Category::where('sexe', 'femme')->get(),
            'categoriesHomme' => Category::where('sexe', 'homme')->get(),
        ];
    }

    public function about()
    {
        return view('about', $this->loadCategories());
    }

    public function politiqueConf()
    {
        return view('politique_conf', $this->loadCategories());
    }

    public function politiqueCookies()
    {
        return view('politique_cookies', $this->loadCategories());
    }

    public function contact()
    {
        return view('contact', $this->loadCategories());
    }

    public function aideRetour()
    {
        return view('aide_retour', $this->loadCategories());
    }

    public function aideLivraison()
    {
        return view('aide_livraison', $this->loadCategories());
    }

    public function aidePaiement()
    {
        return view('aide_paiement', $this->loadCategories());
    }
}

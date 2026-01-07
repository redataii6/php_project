<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produit;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Category;
use App\Models\Commande;
use App\Models\Commande_Item;
use App\Models\ProductImage;
use App\Models\ProduitVariante;
use App\Support\CustomQueryBuilder;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function admin()
    {
        $startOfThisMonth = Carbon::now()->startOfMonth();
        $endOfThisMonth = Carbon::now()->endOfMonth();
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        $revenueLastMonth = Commande::where('statut', 'payée')
            ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->sum('total');

        $revenueThisMonth = Commande::where('statut', 'payée')
            ->whereBetween('created_at', [$startOfThisMonth, $endOfThisMonth])
            ->sum('total');

        if ($revenueLastMonth != 0) {
            $pourcentageRv = (($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100;
        } else {
            $pourcentageRv = 0;
        }
        $pourcentageRv = round($pourcentageRv, 2);
        $variationRv = ($pourcentageRv >= 0 ? '+' : '') . $pourcentageRv . '%';

        if ($revenueThisMonth >= 1000000) {
            $revenueThisMonth = number_format($revenueThisMonth / 1000000, 1, ',', '') . 'M MAD';
        } elseif ($revenueThisMonth >= 10000) {
            $revenueThisMonth = number_format($revenueThisMonth / 1000, 1, ',', '') . 'K MAD';
        } else {
            $revenueThisMonth = rtrim(rtrim(number_format($revenueThisMonth, 2, ',', ''), '0'), ',') . ' MAD';
        }


        $OrdersLastMonth = Commande::where('statut', 'payée')
            ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->count();
        $OrdersThisMonth = Commande::where('statut', '!=', 'Annulée')
            ->whereBetween('created_at', [$startOfThisMonth, $endOfThisMonth])
            ->count();
        if ($OrdersLastMonth != 0) {
            $pourcentage = (($OrdersThisMonth - $OrdersLastMonth) / $OrdersLastMonth) * 100;
        } else {
            $pourcentage = 0;
        }
        $pourcentageOrders = round($pourcentage, 2);
        $variationOrders = ($pourcentageOrders >= 0 ? '+' : '') . $pourcentageOrders . '%';



        $UsersLastMonth = User::where('role', 'client')
            ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->count();
        $UsersThisMonth = User::where('role', 'client')
            ->whereBetween('created_at', [$startOfThisMonth, $endOfThisMonth])
            ->count();
        if ($UsersLastMonth != 0) {
            $pourcentage = (($UsersThisMonth - $UsersLastMonth) / $UsersLastMonth) * 100;
        } else {
            $pourcentage = 0;
        }
        $pourcentageUsers = round($pourcentage, 2);
        $variationUsers = ($pourcentageUsers >= 0 ? '+' : '') . $pourcentageUsers . '%';


        $topVilles = Commande::select('ville', DB::raw('count(*) as total'))
            ->where('statut', 'payée')
            ->groupBy('ville')
            ->orderByDesc('total')
            ->take(6)
            ->get();



        $topUsers = User::where('role', 'client')
            ->withCount(['commandes as total_orders' => function ($query) {
                $query->where('statut', 'payée');
            }])
            ->withSum(['commandes as total_amount' => function ($query) {
                $query->where('statut', 'payée');
            }], 'total')
            ->orderByDesc('total_orders')
            ->take(6)
            ->get();

        foreach ($topUsers as $user) {
            $montant = $user->total_amount ?? 0;

            if ($montant >= 1000) {
                $user->formatted_total_amount = number_format($montant / 1000, ($montant % 1000 >= 100) ? 1 : 0, ',', '') . 'K MAD';
            } else {
                $user->formatted_total_amount = $montant . ' MAD';
            }
        }



        $mois = collect(range(1, 12))->map(function ($m) {
            return Carbon::create()->month($m)->format('F');
        });

        $hommeData = array_fill(1, 12, 0);
        $femmeData = array_fill(1, 12, 0);

        $commandes = Commande::with('commande_item.produit.category')
            ->where('statut', 'payée')
            ->whereYear('created_at', now()->year)
            ->get();

        foreach ($commandes as $commande) {
            $moisCommande = Carbon::parse($commande->created_at)->month;
            foreach ($commande->commande_item as $item) {
                $produit = $item->produit;

                if ($produit && $produit->category) {
                    $sexe = $produit->category->sexe;

                    if ($sexe === 'homme') {
                        $hommeData[$moisCommande] += $item->quantite;
                    } elseif ($sexe === 'femme') {
                        $femmeData[$moisCommande] += $item->quantite;
                    }
                }
            }
        }
        $totalData = [];

        for ($i = 1; $i <= 12; $i++) {
            $totalData[] = $hommeData[$i] + $femmeData[$i];
        }

        $data = [
            'mois' => $mois->values(),
            'hommes' => array_values($hommeData),
            'femmes' => array_values($femmeData),
            'totaux' => $totalData,
        ];


        $topProduits = Produit::withCount('commande__items')
            ->with('firstPhoto')
            ->withSum('commande__items as total_vendus', 'quantite')
            ->orderByDesc('total_vendus')
            ->take(6)
            ->get();

        $commandesRecentes = Commande_Item::with('produit')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.index', ['data' => $data], compact('revenueThisMonth', 'OrdersThisMonth', 'UsersThisMonth', 'topVilles', 'topUsers', 'variationRv', 'pourcentageRv', 'variationOrders', 'pourcentageOrders', 'variationUsers', 'pourcentageUsers', 'topProduits', 'commandesRecentes'));
    }

    /** GESTION DES UTILISATEURS **/
    public function users(Request $request)
    {
        $query = User::where('role', 'client');

        if ($request->filled('nom')) {
            $query->where('name', 'like', '%' . $request->nom . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        return view('admin.users.index', compact('users'));
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Utilisateur supprimé.');
    }

    /** GESTION DES PRODUITS **/
    public function produits(Request $request)
    {
        $query = Produit::with(['category', 'firstPhoto'])
            ->withCount('favoritedBy')
            ->with('commande__items');

        $filters = [];

        // Filtre par nom (contains)
        if ($request->filled('nom')) {
            $filters[] = [
                'column' => 'nom',
                'operator' => 'contains',
                'query_1' => $request->input('nom'),
            ];
        }

        // Filtre par catégorie (exact match sur category_id)
        if ($request->filled('categorie')) {
            $filters[] = [
                'column' => 'categorie_id',
                'operator' => 'equalTo',
                'query_1' => $request->input('categorie'),
            ];
        }

        // Filtre par stock (en fonction des plages)
        if ($request->filled('stock')) {
            $stockValue = $request->input('stock');

            switch ($stockValue) {
                case '+ 500':
                    $filters[] = [
                        'column' => 'stock',
                        'operator' => 'greaterThan',
                        'query_1' => 500,
                    ];
                    break;
                case '201 - 500':
                    $filters[] = [
                        'column' => 'stock',
                        'operator' => 'between',
                        'query_1' => 201,
                        'query_2' => 500,
                    ];
                    break;
                case '51 - 200':
                    $filters[] = [
                        'column' => 'stock',
                        'operator' => 'between',
                        'query_1' => 51,
                        'query_2' => 200,
                    ];
                    break;
                case '1 - 50':
                    $filters[] = [
                        'column' => 'stock',
                        'operator' => 'between',
                        'query_1' => 1,
                        'query_2' => 50,
                    ];
                    break;
                case '0':
                    $filters[] = [
                        'column' => 'stock',
                        'operator' => 'equalTo',
                        'query_1' => 0,
                    ];
                    break;
            }
        }

        // Filtre par prix minimum
        if ($request->filled('minprix')) {
            $filters[] = [
                'column' => 'prix',
                'operator' => 'greaterThanOrEqualTo',
                'query_1' => $request->input('minprix'),
            ];
        }

        // Filtre par prix maximum
        if ($request->filled('maxprix')) {
            $filters[] = [
                'column' => 'prix',
                'operator' => 'lessThanOrEqualTo',
                'query_1' => $request->input('maxprix'),
            ];
        }

        // Application des filtres via CustomQueryBuilder
        $data = [
            'f' => $filters,
            'filter_match' => 'and',
        ];

        $queryBuilder = new CustomQueryBuilder();
        $query = $queryBuilder->apply($query, $data);

        // Pagination avec maintien des filtres dans l'URL
        $produits = $query->orderBy('created_at', 'desc')->get();

        $categories = Category::all();
        return view('admin.produits.liste', compact('produits', 'categories'));
    }

    public function createProduit()
    {
        $categories = Category::all();
        return view('admin.produits.create', compact('categories'));
    }

    public function storeProduit(Request $request)
    {
        $data = $request->validate(
            [
                'nom' => 'required|string|max:255',
                'description' => 'required|string',
                'prix' => 'required|numeric|min:0',
                'stock' => 'integer|min:0',
                'categorie_id' => 'required|exists:categories,id',

                'variants' => 'required|array',
                'variants.*.id' => 'nullable|exists:produit_variantes,id',
                'variants.*.color.name' => 'required|string',
                'variants.*.color.hex_code' => ['required', 'string', 'regex:/^#([a-f0-9]{3}){1,2}$/i'],
                'variants.*.size' => 'required|string',
                'variants.*.stock' => 'required|integer|min:0',

                'images' => 'nullable|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
            ],
            [
                'nom.required' => 'Le nom est obligatoire',
                'nom.string' => 'Le nom doit être une chaine de caractères.',
                'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',

                'description.required' => 'La description est obligatoire.',
                'description.string' => 'La description doit être une chaine de caractères.',

                'prix.required' => 'Le prix est obligatoire.',
                'prix.numeric' => 'Le prix doit être un nombre.',
                'prix.min' => 'Le prix ne peut pas être négatif.',

                'categorie_id.required' => 'La catégorie est obligatoire.',
                'categorie_id.exists' => 'La catégorie sélectionnée n\'existe pas.',

                'variants.required' => 'Les variantes sont obligatoires.',
                'variants.array' => 'Les variantes doivent être envoyées sous forme de tableau.',

                'variants.*.color.name.required' => 'Le nom de la couleur de la variante est obligatoire.',
                'variants.*.color.name.string' => 'Le nom de la couleur doit être une chaine de caractères.',

                'variants.*.color.hex_code.required' => 'Le code hexadécimal de la couleur est obligatoire.',
                'variants.*.color.hex_code.string' => 'Le code de la couleur doit être une chaine de caractères.',
                'variants.*.color.hex_code.regex' => 'Le code de la couleur doit commencer par # et contenir 3 ou 6 caractères hexadécimaux.',

                'variants.*.size.required' => 'La taille de la variante est obligatoire.',
                'variants.*.size.string' => 'La taille doit être une chaine de caractères.',

                'variants.*.stock.required' => 'Le stock de la variante est obligatoire.',
                'variants.*.stock.integer' => 'Le stock de la variante doit être un entier.',
                'variants.*.stock.min' => 'Le stock de la variante ne peut pas être négatif.',

                'images.*.image' => 'Chaque élément de ce tableau doit être une image.',
                'images.*.mimes' => 'Les images doivent être de format jpeg, png, jpg ou webp.',
                'images.*.max' => 'Chaque image ne doit pas dépasser 2 Mo.',
            ]
        );

        // Crée produit 
        $produit = Produit::create([
            'nom' => $data['nom'],
            'description' => $data['description'],
            'prix' => $data['prix'],
            'categorie_id' => $data['categorie_id'],
            'stock' => $data['stock'],
        ]);

        foreach ($data['variants'] as $variant) {
            // Trouve ou crée couleur
            $color = ProductColor::firstOrCreate(
                ['name' => $variant['color']['name']],
                ['hex_code' => $variant['color']['hex_code']]
            );

            // Trouve ou crée taille
            $size = ProductSize::firstOrCreate(['size' => $variant['size']]);

            // Crée variant avec stock
            ProduitVariante::create([
                'produit_id' => $produit->id,
                'color_id' => $color->id,
                'size_id' => $size->id,
                'stock' => $variant['stock'],
            ]);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('produits', 'public');

                ProductImage::create([
                    'produit_id' => $produit->id,
                    'image_path' => $path,
                ]);
            }
        }


        return redirect()->route('admin.produits.index')->with('success', 'Produit ajouté avec variantes');
    }

    public function editProduit($id)
    {
        $produit = Produit::with(['variantes.taille', 'variantes.couleur'])->findOrFail($id);
        $categories = Category::all();

        return view('admin.produits.edit', compact('produit', 'categories'));
    }

    public function updateProduit(Request $request, $id)
    {
        $produit = Produit::with('variantes.taille', 'variantes.couleur')->findOrFail($id);

        $data = $request->validate(
            [
                'nom' => 'required|string|max:255',
                'description' => 'required|string',
                'prix' => 'required|numeric|min:0',
                'stock' => 'integer|min:0',
                'categorie_id' => 'required|exists:categories,id',

                'variants' => 'required|array',
                'variants.*.id' => 'nullable|exists:produit_variantes,id',
                'variants.*.color.name' => 'required|string',
                'variants.*.color.hex_code' => ['required', 'string', 'regex:/^#([a-f0-9]{3}){1,2}$/i'],
                'variants.*.size' => 'required|string',
                'variants.*.stock' => 'required|integer|min:0',

                'images' => 'nullable|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
            ],
            [
                'nom.required' => 'Le nom est obligatoire',
                'nom.string' => 'Le nom doit être une chaine de caractères.',
                'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',

                'description.required' => 'La description est obligatoire.',
                'description.string' => 'La description doit être une chaine de caractères.',

                'prix.required' => 'Le prix est obligatoire.',
                'prix.numeric' => 'Le prix doit être un nombre.',
                'prix.min' => 'Le prix ne peut pas être négatif.',

                'categorie_id.required' => 'La catégorie est obligatoire.',
                'categorie_id.exists' => 'La catégorie sélectionnée n\'existe pas.',

                'variants.required' => 'Les variantes sont obligatoires.',
                'variants.array' => 'Les variantes doivent être envoyées sous forme de tableau.',

                'variants.*.color.name.required' => 'Le nom de la couleur de la variante est obligatoire.',
                'variants.*.color.name.string' => 'Le nom de la couleur doit être une chaine de caractères.',

                'variants.*.color.hex_code.required' => 'Le code hexadécimal de la couleur est obligatoire.',
                'variants.*.color.hex_code.string' => 'Le code de la couleur doit être une chaine de caractères.',
                'variants.*.color.hex_code.regex' => 'Le code de la couleur doit commencer par # et contenir 3 ou 6 caractères hexadécimaux.',

                'variants.*.size.required' => 'La taille de la variante est obligatoire.',
                'variants.*.size.string' => 'La taille doit être une chaine de caractères.',

                'variants.*.stock.required' => 'Le stock de la variante est obligatoire.',
                'variants.*.stock.integer' => 'Le stock de la variante doit être un entier.',
                'variants.*.stock.min' => 'Le stock de la variante ne peut pas être négatif.',

                'images.*.image' => 'Chaque élément de ce tableau doit être une image.',
                'images.*.mimes' => 'Les images doivent être de format jpeg, png, jpg ou webp.',
                'images.*.max' => 'Chaque image ne doit pas dépasser 2 Mo.',
            ]
        );

        DB::beginTransaction();
        try {
            $produit->update([
                'nom' => $data['nom'],
                'description' => $data['description'],
                'prix' => $data['prix'],
                'categorie_id' => $data['categorie_id'],
                'stock' => $data['stock'],
            ]);

            $receivedIds = [];

            foreach ($data['variants'] as $variant) {
                $color = ProductColor::firstOrCreate(
                    ['name' => $variant['color']['name']],
                    ['hex_code' => $variant['color']['hex_code']]
                );

                $size = ProductSize::firstOrCreate(['size' => $variant['size']]);

                if (!empty($variant['id'])) {
                    $variante = ProduitVariante::findOrFail($variant['id']);
                    $variante->update([
                        'color_id' => $color->id,
                        'size_id' => $size->id,
                        'stock' => $variant['stock'],
                    ]);
                    $receivedIds[] = $variante->id;
                } else {
                    $newVariante = ProduitVariante::create([
                        'produit_id' => $produit->id,
                        'color_id' => $color->id,
                        'size_id' => $size->id,
                        'stock' => $variant['stock'],
                    ]);
                    $receivedIds[] = $newVariante->id;
                }
            }

            // Supprimer les variantes non présentes
            $produit->variantes()->whereNotIn('id', $receivedIds)->delete();

            // Images
            if ($request->hasFile('images')) {
                foreach ($produit->images as $img) {
                    Storage::disk('public')->delete($img->image_path);
                    $img->delete();
                }

                foreach ($request->file('images') as $image) {
                    $path = $image->store('produits', 'public');
                    ProductImage::create([
                        'produit_id' => $produit->id,
                        'image_path' => $path,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.produits.index')->with('success', 'Produit mis à jour avec variantes.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    public function deleteProduit($id)
    {
        Produit::findOrFail($id)->delete();
        return back()->with('success', 'Produit supprimé.');
    }


    /** GESTION DES CATÉGORIES **/
    public function categories(Request $request)
    {
        $query = Category::withCount('produits');

        // Filtrage par nom
        if ($request->filled('nomF')) {
            $query->where('nom', 'like', '%' . $request->nomF . '%');
        }

        // Filtrage par sexe
        if ($request->filled('sexeF')) {
            $query->where('sexe', $request->sexeF);
        }

        $categories = $query->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function editCategorie($id)
    {
        $categorie = Category::findOrFail($id);
        return view('admin.categories.edit', compact('categorie'));
    }

    public function storeCategorie(Request $request)
    {
        $request->validate(
            [
                'nom' => 'required|string',
                'sexe' => 'required|in:homme,femme'
            ],
            [
                'nom.required' => 'Le nom est obligatoire.',
                'nom.string' => 'Le nom doit être une chaine de caractères.',

                'sexe.required' => 'Le sexe est obligatoire.',
                'sexe.in' => 'Le sexe doit être "homme" ou "femme".',
            ]
        );
        Category::create([
            'nom' => $request->nom,
            'sexe' => $request->sexe
        ]);
        return back()->with('success', 'Catégorie créée.');
    }

    public function updateCategorie(Request $request, $id)
    {
        $categories = Category::findOrFail($id);

        $data = $request->validate(
            [
                'nom' => 'required|string|unique:categories,nom,' . $id,
                'sexe' => 'required|in:homme,femme'
            ],
            [
                'nom.required' => 'Le nom est obligatoire.',
                'nom.string' => 'Le nom doit être une chaine de caractères.',
                'nom.unique' => 'Ce nom existe déjà dans la catégorie.',

                'sexe.required' => 'Le sexe est obligatoire.',
                'sexe.in' => 'Le sexe doit être "homme" ou "femme".',
            ]
        );

        $categories->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Categorie mis à jour.');
    }

    public function deleteCategorie($id)
    {
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Catégorie supprimée.');
    }

    public function showCommandes(Request $request)
    {
        $query = Commande::with('commande_item.produit')
            ->where('created_at', '>=', Carbon::now()->subMonth())
            ->orderByDesc('created_at');

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('nom')) {
            $search = trim($request->nom);
            $query->where(function ($q) use ($search) {
                $q->whereRaw("CONCAT(prenom, ' ', nom) LIKE ?", ["%{$search}%"])
                    ->orWhereRaw("CONCAT(nom, ' ', prenom) LIKE ?", ["%{$search}%"]);
            });
        }

        if ($request->filled('ville')) {
            $query->where('ville', $request->ville);
        }

        if ($request->filled('paiement')) {
            $query->where('statut', $request->paiement);
        }

        // Récupérer et grouper les résultats
        $commandes = $query->get()->groupBy(function ($commande) {
            $date = $commande->created_at->startOfDay();
            $now = Carbon::now()->startOfDay();

            if ($date->equalTo($now)) {
                return 'Aujourd\'hui';
            } elseif ($date->equalTo($now->copy()->subDay())) {
                return 'Hier';
            } elseif ($date->greaterThanOrEqualTo($now->copy()->subDays(7))) {
                return 'Derniers 7 jours';
            } else {
                return $commande->created_at->format('M Y');
            }
        });

        $categories = Category::all();

        return view('admin.commandes.index', compact('commandes', 'categories'));
    }


    public function showHistoriqueCommandes(Request $request)
    {
        $startOfCurrentMonth = Carbon::now()->startOfMonth();

        // 🔸 Récupérer les mois disponibles sous forme 'YYYY-MM'
        $moisDisponibles = Commande::where('created_at', '<', $startOfCurrentMonth)
            ->select('created_at')
            ->get()
            ->groupBy(function ($commande) {
                return $commande->created_at->format('Y-m');
            });

        // 🔸 Mois sélectionné depuis la requête ou par défaut = mois précédent
        $moisSelectionne = $request->input('mois');

        if (!$moisSelectionne) {
            $moisSelectionne = Carbon::now()->subMonth()->format('Y-m');
        }

        $query = Commande::with('commande_item.produit')
            ->whereYear('created_at', substr($moisSelectionne, 0, 4))
            ->whereMonth('created_at', substr($moisSelectionne, 5, 2))
            ->orderByDesc('created_at');

        // 🔸 Filtres classiques
        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('nom')) {
            $search = trim($request->nom);
            $query->where(function ($q) use ($search) {
                $q->whereRaw("CONCAT(prenom, ' ', nom) LIKE ?", ["%{$search}%"])
                    ->orWhereRaw("CONCAT(nom, ' ', prenom) LIKE ?", ["%{$search}%"]);
            });
        }

        if ($request->filled('ville')) {
            $query->where('ville', $request->ville);
        }

        if ($request->filled('paiement')) {
            $query->where('statut', $request->paiement);
        }

        // 🔸 Grouper par jour pour affichage
        $commandes = $query->get()->groupBy(function ($commande) {
            return $commande->created_at->format('d M Y');
        });

        $categories = Category::all();

        return view('admin.commandes.historique', [
            'commandes' => $commandes,
            'categories' => $categories,
            'moisDisponibles' => $moisDisponibles,
            'moisSelectionne' => $moisSelectionne,
        ]);
    }




    public function marquerCommeLivree($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->livraison = 'livrée';
        $commande->statut = 'payée';
        $commande->save();

        return redirect()->back()->with('success', 'Commande marquée comme livrée.');
    }

    public function marquerCommeAnnuler($id)
    {
        $commande = Commande::with('commande_item')->findOrFail($id);
        $commande->livraison = 'Annulée';
        $commande->statut = 'Annulée';
        $commande->save();

        foreach ($commande->commande_item as $item) {
            $variante = ProduitVariante::where('produit_id', $item->produit_id)
                ->where('color_id', $item->product_color_id)
                ->where('size_id', $item->product_size_id)
                ->first();
            if ($variante) {
                $variante->stock += $item->quantite;
                $variante->save();
                $produit = Produit::findOrFail($item->produit_id);
                $produit->stock += $item->quantite;
                $produit->save();
            }
        }
        return redirect()->back()->with('success', 'Commande marquée comme annulée.');
    }


    public function genererPDF(Request $request)
    {
        $ids = $request->input('commandes', []);

        if (empty($ids)) {
            return back()->with('error', 'Aucune commande sélectionnée.');
        }

        $commandes = Commande::with('commande_item.produit', 'commande_item.taille', 'commande_item.couleur', 'commande_item.produit.category')
            ->whereIn('id', $ids)
            ->orderByDesc('created_at')
            ->where('livraison', '!=', 'Annulée')
            ->where('livraison', '!=', 'livrée')
            ->get();
        $date = Carbon::now()->format('d/m/Y');

        $pdf = Pdf::loadView('admin.commandes.pdf', compact('commandes', 'date'));
        return $pdf->download('commandes_selectionnees.pdf');
    }

    public function genererFacturePDF($id)
    {
        $commande = Commande::with('commande_item.produit', 'commande_item.taille', 'commande_item.couleur')->findOrFail($id);

        $pdf = Pdf::loadView('admin.commandes.facture-colis', compact('commande'))->setPaper('A5');

        return $pdf->download('facture_colis_' . $commande->id . '.pdf');
    }
}

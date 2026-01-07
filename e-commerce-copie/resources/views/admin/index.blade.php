<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/css/sidebar.css'])
</head>

<body>
    <div class="flex">
        <div class="sidebar !fixed">
            <ul class="nav">
                <li id="tophome">
                    <a href="{{ route('admin.index')}}" class="active">
                        <img class="logos home hidden" src="{{ asset('dashboard.png') }}" alt="">
                        <img class="logos home hv !block" src="{{ asset('dashboard_hv.png') }}" alt=""> Home</a>
                </li>
                <li>
                    <a href="{{ route('admin.produits.index')}}">
                        <img class="logos formateur " src="{{ asset('shirt.png') }}" alt="">
                        <img class="logos formateur hv " src="{{ asset('shirt_hv.png') }}" alt="">Produits</a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}">
                        <img class="logos stagiaire" src="{{ asset('collection.png') }}" alt="">
                        <img class="logos stagiaire hv" src="{{ asset('collection_hv.png') }}" alt="">Collections</a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}">
                        <img class="logos clients" src="{{ asset('customer.png') }}" alt="">
                        <img class="logos clients hv" src="{{ asset('customer_hv.png') }}" alt="">Client</a>
                </li>
                <li>
                    <a href="{{ route('admin.commandes.index') }}">
                        <img class="logos commandes" src="{{ asset('box.png') }}" alt="">
                        <img class="logos commandes hv" src="{{ asset('box_hv.png') }}" alt="">Commandes</a>
                </li>
                <li>
                    <a href="{{ route('admin.message.index') }}">
                        <img class="logos comments" src="{{ asset('commentary.png') }}" alt="">
                        <img class="logos comments hv" src="{{ asset('commentary_hv.png') }}" alt=""><span class="!ml-0.5">Commentaires</span></a>
                </li>
                <!-- <li>
                    <a href="">
                        <img class="logos demande" src="certificat.png" alt="">
                        <img class="logos demande hv" src="certificat-hover.png"
                            alt=""><span>Certificats</span></a>
                </li> -->
                <li id="logout">
                    <a href="{{ route('logout') }}">
                        <img class="logos" src="{{ asset('log-out.png') }}" alt="">
                        <img class="logos hv" src="{{ asset('log-out_hv.png') }}" alt="">Log out</a>
                </li>
            </ul>
        </div>
        <div class="ml-70 w-[80%]">
            <div class="flex justify-between items-center mt-3">
                <img class="w-[90px] h-[55px] " src="{{ asset('Shiny2.png') }}" alt="">
                <div class="flex items-center gap-2">
                    <p class="text-black text-xl font-semibold">{{ auth()->user()->name }}</p>
                    <img class="w-11 h-11 " src="{{ asset('admin.png') }}" alt="">

                </div>
            </div>
            <div class="flex mt-10">
                <img class="w-11 h-9 mt-1" src="{{ asset('statistiques.png') }}" alt="">
                <h1 class=" font-extrabold text-5xl mb-5 ml-5" style="font-family: 'Apple Chancery';">Statistiques</h1>
            </div>
            <div class="flex justify-between items-start mt-10">

                <div class="w-[73%]">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-white p-4 rounded-lg shadow">
                            <div class="flex">
                                <img class="w-10 h-10  bg-green-100 p-2 rounded-md" src="{{ asset('revenus(1).png') }}" alt="">
                                <h2 class="text-lg ml-2 mt-1 text-gray-700">Revenus</h2>
                            </div>
                            <div class="flex mt-5 jusstify-between">
                                <p class="text-[28px] font-bold mt-1">{{ $revenueThisMonth }}</p>
                                <div class="text-right ml-auto">
                                    @if ($pourcentageRv >= 0)
                                    <div class="p-1 bg-green-100 rounded-md flex items-center justify-center w-auto ml-auto">
                                        <img class="w-4 h-4 mr-2" src="{{ asset('up.png') }}" alt="">
                                        <p class="text-green-700 text-sm">{{ $variationRv }}</p>
                                    </div>
                                    @else
                                    <div class="p-1 bg-red-100 rounded-md flex items-center justify-center w-auto ml-auto">
                                        <img class="w-4 h-4 mr-2" src="{{ asset('down.png') }}" alt="">
                                        <p class="text-red-700 text-sm">{{ $variationRv }}</p>
                                    </div>
                                    @endif
                                    <p class="text-gray-500 text-xs">depuis mois dernier</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow">
                            <div class="flex">
                                <img class="w-10 h-10  bg-orange-100 p-2 rounded-md" src="{{ asset('colis.png') }}" alt="">
                                <h2 class="text-lg ml-2 mt-1 text-gray-700">Commandes</h2>
                            </div>
                            <div class="flex mt-5 jusstify-between">
                                <p class="text-2xl font-bold">{{ $OrdersThisMonth }}</p>
                                <div class="text-right ml-auto">
                                    @if ($pourcentageOrders >= 0)
                                    <div class="p-1 bg-green-100 rounded-md flex items-center justify-center w-auto ml-auto">
                                        <img class="w-4 h-4 mr-2" src="{{ asset('up.png') }}" alt="">
                                        <p class="text-green-700 text-sm">{{ $variationOrders }}</p>
                                    </div>
                                    @else
                                    <div class="p-1 bg-red-100 rounded-md flex items-center justify-center w-auto ml-auto">
                                        <img class="w-4 h-4 mr-2" src="{{ asset('down.png') }}" alt="">
                                        <p class="text-red-700 text-sm">{{ $variationOrders }}</p>
                                    </div>
                                    @endif
                                    <p class="text-gray-500 text-xs">depuis mois dernier</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow">
                            <div class="flex">
                                <img class="w-10 h-10  bg-blue-100 p-2 rounded-md" src="{{ asset('gens(1).png') }}" alt="">
                                <h2 class="text-lg ml-2 mt-1 text-gray-700">Clients</h2>
                            </div>
                            <div class="flex mt-5 jusstify-between">
                                <p class="text-2xl font-bold">{{ $UsersThisMonth }}</p>
                                <div class="text-right ml-auto">
                                    @if ($pourcentageUsers >= 0)
                                    <div class="p-1 bg-green-100 rounded-md flex items-center justify-center w-auto ml-auto">
                                        <img class="w-4 h-4 mr-2" src="{{ asset('up.png') }}" alt="">
                                        <p class="text-green-700 text-sm">{{ $variationUsers }}</p>
                                    </div>
                                    @else
                                    <div class="p-1 bg-red-100 rounded-md flex items-center justify-center w-auto ml-auto">
                                        <img class="w-4 h-4 mr-2" src="{{ asset('down.png') }}" alt="">
                                        <p class="text-red-700 text-sm">{{ $variationUsers }}</p>
                                    </div>
                                    @endif
                                    <p class="text-gray-500 text-xs">depuis mois dernier</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings Chart -->
                    <div class="bg-white p-6 rounded-lg shadow mb-6 h-auto">
                        <div class="flex justify-between mb-4">
                            <h2 class="text-lg font-semibold mb-4">Ventes mensuelles</h2>
                            <div>
                                <div class="flex items-center">
                                    <div class="w-4 h-4 bg-pink-600 rounded-full "></div>
                                    <p class="text-sm text-gray-700 ml-2 items-center">Ventes Femme</p>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-4 h-4 bg-blue-600 rounded-full"></div>
                                    <p class="text-sm text-gray-700 ml-2 items-center">Ventes Homme</p>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-4 h-4 bg-green-600 rounded-full"></div>
                                    <p class="text-sm text-gray-700 ml-2 items-center">Ventes Total</p>
                                </div>
                            </div>
                        </div>
                        <div id="chart-container">
                            <canvas id="vente-par-sexe"></canvas>
                        </div>

                    </div>
                    <!-- Top Products -->
                    <div class="bg-white p-6 rounded-lg shadow mb-6">
                        <div class="flex justify-between mb-4">
                            <h2 class="text-lg font-semibold">Top Produits</h2>
                            <a href="{{ route('admin.produits.index') }}" class="text-sm text-gray-500 mt-1">Voir tout</a>
                        </div>
                        <hr class="text-gray-300">
                        <table class="min-w-full">
                            <thead class="border-b border-gray-300">
                                <tr class="text-sm text-gray-500 text-center">
                                    <th scope="col" class="px-4 py-2 text-center"></th>
                                    <th scope="col" class="px-4 py-2 text-left">Produit</th>
                                    <th scope="col" class="px-4 py-2 text-center">Catégorie</th>
                                    <th scope="col" class="px-4 py-2 text-center">Stock</th>
                                    <th scope="col" class="px-4 py-2 text-center">Prix</th>
                                    <th scope="col" class="px-4 py-2 text-center">Total Ventes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topProduits as $produit)
                                <tr class="text-sm text-gray-700 text-center">
                                    <td class="px-4 py-3 text-center">
                                        <img class="w-10 h-10 rounded-md mx-auto" src="{{ asset('storage/' . $produit->firstPhoto->image_path) }}" alt="">
                                    </td>
                                    <td class="px-4 py-3 text-left">{{ $produit->nom }}</td>
                                    <td class="px-4 py-3 text-center">{{ $produit->category->nom }}</td>
                                    <td class="px-4 py-3 text-center">{{ $produit->stock }}</td>
                                    <td class="px-4 py-3 text-center">{{ $produit->prix }} MAD</td>
                                    <td class="px-4 py-3 text-center">{{ $produit->total_vendus }} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- Side Stats -->
                <div class="grid grid-cols-1 gap-6 w-[25%] ">
                    <!-- Countries -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex mb-4">
                            <img class="w-8" src="{{ asset('ville.png') }}" alt="">
                            <h2 class="text-lg font-semibold mt-1">Top Villes par Ventes</h2>
                        </div>
                        <hr class="mb-4 text-gray-300">
                        <ul class="text-sm space-y-2">
                            @foreach ($topVilles as $ville)
                            <li class="flex justify-between"><span>{{ $ville->ville }}</span><span>{{ $ville->total }}</span></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex justify-between mb-4">
                            <h2 class="text-lg font-semibold">Top Clients</h2>
                            <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 mt-1">Voir tout</a>
                        </div>
                        <hr class="mb-4 text-gray-300">
                        <ul class="text-sm space-y-2">
                            @foreach ($topUsers as $user)
                            <div class="flex h-10 items-center">
                                <img class="rounded-full w-[35px] h-[35px] bg-black mt-6" src="{{ asset('user.png') }}" alt="">
                                <li class=" ml-2 mt-5"><span class="font-semibold">{{ $user->name }}</span><span class="flex text-gray-500 text-xs">{{ $user->total_orders }} Commande</span></li>
                                <div class="ml-auto mt-5">
                                    <span class="text-gray-900 text-md font-bold">{{ $user->formatted_total_amount }}</span>
                                </div>
                            </div>
                            @endforeach
                        </ul>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex justify-between mb-4">
                            <h2 class="text-lg font-semibold">Commandes récentes</h2>
                            <a href="{{ route('admin.commandes.index') }}" class="text-sm text-gray-500 mt-1">Voir tout</a>
                        </div>
                        <hr class="mb-4 text-gray-300">
                        <ul class="text-sm space-y-5">
                            @foreach ($commandesRecentes as $commande)
                            <div class="flex h-10 items-center">
                                <img class="w-10 h-12 rounded-md" src="{{ asset('storage/' . $commande->produit->firstPhoto->image_path) }}" alt="">
                                <li class="ml-2"><span class="font-semibold text-[13px]">{{ $commande->produit->nom }}</span><span class="flex text-gray-500 text-xs">{{ $commande->produit->category->nom }}</span></li>
                                <div class="ml-auto mt-5">
                                    <span class="text-gray-900 text-xs font-bold">{{ $commande->produit->prix }} MAD</span>
                                </div>
                            </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const data = @json($data);

        const ctx = document.getElementById('vente-par-sexe').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.mois,
                datasets: [{
                        label: 'Ventes Homme',
                        backgroundColor: '#3b82f6',
                        data: data.hommes,
                        borderRadius: 10,
                    },
                    {
                        label: 'Ventes Femme',
                        backgroundColor: '#ec4899',
                        data: data.femmes,
                        borderRadius: 10,
                    },
                    {
                        label: 'Total Ventes',
                        backgroundColor: '#10b981', // vert
                        data: data.totaux,
                        borderRadius: 10,
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#000'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        },
                        ticks: {
                            precision: 0,
                            color: '#000'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }

        });
    </script>
</body>

</html>
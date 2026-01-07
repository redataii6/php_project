<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/css/sidebar.css'])
</head>

<body>
    <div class="flex w-full">
        <div class="sidebar fixed">
            <ul class="nav">
                <li id="tophome">
                    <a href="{{ route('admin.index')}}">
                        <img class="logos home" src="{{ asset('dashboard.png') }}" alt="">
                        <img class="logos home hv" src="{{ asset('dashboard_hv.png') }}" alt=""> Home</a>
                </li>
                <li>
                    <a href="{{ route('admin.produits.index')}}" class="active">
                        <img class="logos formateur hidden" src="{{ asset('shirt.png') }}" alt="">
                        <img class="logos formateur hv !block" src="{{ asset('shirt_hv.png') }}" alt="">Produits</a>
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
                    <a href="{{ route('admin.commandes.index') }}">
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
            <div class="mt-17">
                <div class="flex justify-between items-center mb-5">
                    <h1 class=" font-extrabold text-5xl mb-5 ml-5" style="font-family: 'Apple Chancery';">Produits</h1>
                    <a href="{{ route('admin.produits.ajout') }}">
                        <input
                            class="float-end py-3 px-4 font-semibold text-white text-center border bg-black rounded-[10px]"
                            type="button" value="+ Ajouter produit">
                    </a>
                </div>
                <p class="ml-16">Utilisez le filtre pour effectuer une recherche plus rapide.</p>
                <form method="GET" action="{{ route('admin.produits.index') }}" class="mt-8">
                    @csrf
                    <div class="flex space-x-4 ml-40">
                        <div class="relative h-11 w-full max-w-[300px]">
                            <input id="nom" name="nom" value="{{ request('nom') }}"
                                class="h-full w-full border-b border-gray-400 bg-transparent pt-4 pb-1.5  text-sm font-normal text-blue-gray-700 focus:border-gray-900 focus:outline-0  " />
                            <label
                                class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full text-sm font-normal  text-gray-900 ">
                                Nom
                            </label>
                        </div>
                        <div class="relative h-11 w-full  max-w-[300px]">
                            <label for="categorie" 
                                class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full text-sm font-normal  text-gray-900 ">
                                catégorie
                            </label>
                            <div class="sm:col-span-3">
                                <div class="relative h-11 w-full max-w-[300px]">
                                    <select id="categorie" name="categorie" 
                                        class=" h-full w-full border border-gray-400 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  focus:border-1 focus:border-black focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent ">
                                        <option value=""></option>
                                        @foreach( $categories as $categorie)
                                            <option value="{{ $categorie->id }}" {{ request('categorie') == $categorie->id ? 'selected' : '' }} >{{ $categorie->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="relative h-11 w-full  max-w-[300px]">
                            <label for="stock"
                                class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full text-sm font-normal  text-gray-900 ">
                                Stock
                            </label>
                            <div class="sm:col-span-3">
                                <div class="relative h-11 w-full max-w-[300px]">
                                    <select id="stock" name="stock" value="{{ request('stock') }}"
                                        class="peer h-full w-full border border-gray-400 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  focus:border-1 focus:border-black focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent ">
                                        <option value=""></option>
                                        <option value="+ 500">+ 500</option>
                                        <option value="201 - 500">201 - 500</option>
                                        <option value="51 - 200">51 - 200</option>
                                        <option value="1 - 50">1 - 50</option>
                                        <option value="0">0</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-4 ml-80 mt-10">
                        <div class="relative h-11 w-full max-w-[300px]">
                            <input id="minprix" name="minprix" value="{{ request('minprix') }}"
                                class="h-full w-full border-b border-gray-400 bg-transparent pt-4 pb-1.5  text-sm font-normal text-blue-gray-700 focus:border-gray-900 focus:outline-0" />
                            <label
                                class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full text-sm font-normal  text-gray-900 ">
                                Min prix
                            </label>
                        </div>
                        <div class="relative h-11 w-full max-w-[300px]">
                            <input id="maxprix" name="maxprix" value="{{ request('maxprix') }}"
                                class="h-full w-full border-b border-gray-400 bg-transparent pt-4 pb-1.5  text-sm font-normal text-blue-gray-700 focus:border-gray-900 focus:outline-0" />
                            <label
                                class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full text-sm font-normal  text-gray-900">
                                Max prix
                            </label>
                        </div>
                    </div>
                    <div class="flex justify-end mb-16 mt-8 mr-22">
                        <a href="{{ route('admin.produits.index') }}" class="mr-5 mt-2 font-medium">Réinitialiser</a>
                        <button type="submit"
                            class=" rounded-md  px-3 py-2 text-sm font-semibold text-white shadow-sm  bg-black">Filtrer</button>
                    </div>

                </form>
            </div>


            <div class="relative overflow-hidden bg-white shadow-md sm:rounded-lg mb-20">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-white uppercase bg-black">
                            <tr>
                                <th scope="col" class="px-4 py-3">Produit</th>
                                <th scope="col" class="px-4 py-3">Catégorie</th>
                                <th scope="col" class="px-4 py-3">Stock</th>
                                <th scope="col" class="px-4 py-3">Prix</th>
                                <th> </th>
                            </tr>
                        </thead>
                        @foreach($produits as $produit)
                        <tbody>

                            <tr class="border-b">
                                <th scope="row" class="flex items-center px-4 py-2 font-medium text-gray-900 ">
                                    <img src="{{ asset('storage/' . $produit->firstPhoto->image_path) }}" alt="" class="w-[25px] h-8 mr-3">
                                    {{ $produit->nom }}
                                </th>
                                <td class="px-4 py-2">
                                    <span class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300">{{ $produit->category->nom }}</span>
                                </td>
                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($produit->stock > 0 && $produit->stock <= 50)
                                        <div class="inline-block w-4 h-4 mr-2 bg-orange-500 rounded-full"></div>
                                        {{ $produit->stock }}
                                        @elseif($produit->stock == 0)
                                        <div class="inline-block w-4 h-4 mr-2 bg-red-500 rounded-full"></div>
                                        {{ $produit->stock }}
                                        @elseif($produit->stock > 50 && $produit->stock < 200)
                                        <div class="inline-block w-4 h-4 mr-2 bg-yellow-400 rounded-full"></div>
                                        {{ $produit->stock }}
                                        @elseif($produit->stock >= 200)
                                        <div class="inline-block w-4 h-4 mr-2 bg-green-500 rounded-full"></div>
                                        {{ $produit->stock }}
                                        @endif
                                        <!-- <div class="inline-block w-4 h-4 mr-2 bg-red-700 rounded-full"></div>
                                        {{ $produit->stock }} -->
                                    </div>
                                </td>
                                <td class="px-4 py-2 font-medium text-gray-900">{{ $produit->prix }} MAD</td>
                                <td class="px-4 py-2 w-[8%]">
                                    <div class="flex space-x-2 items-end">
                                        <a href="{{ route('admin.produits.edit', $produit->id) }}"><img class="w-5 h-5 mb-1" src="{{ asset('stylo.png') }}" alt=""></a>
                                        <form action="{{ route('admin.produits.delete', $produit->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900"><img class="w-6 h-6" src="{{ asset('effacer.png') }}" alt=""></button>
                                        </form>
                                    </div>
                                </td>
                                
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
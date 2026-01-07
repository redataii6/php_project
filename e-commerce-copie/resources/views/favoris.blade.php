<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Favoris - Shiny</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/css/home_page.css')
    @vite('resources/js/app.js')
</head>

<body>
    <!--Menu bar-->
    <div id="container" class="!h-auto">
        <div id="language" class="fixed top-0 w-[90%] z-50 px-2 text-xs">
            <p>MOROCCO | MAD | FRENCH</p>
        </div>
        <div style="background-color: rgb(245, 246, 247);" id="navbar" class="fixed top-[-15px] w-[90%] z-40  px-2">
            <div class="w-[100%] flex justify-between items-center h-[100px] ">
                <img id="menu" src="{{ asset('menu.png') }}" alt="menu" class="md:w-8 md:h-8 z-50 cursor-pointer !w-5 !h-5">
                <div id="menu-liste" class="hidden grid md:grid-cols-1  mt-46 absolute bg-white h-[970px] w-[300px] top-[-170px] left-[-90px] rounded-[20px] shadow-xl/30">
                    <!-- Femme -->
                    <div class=" rounded-2xl ml-22.5 mt-35">
                        <div id="femme" class="flex  cursor-pointer">
                            <h2 class="text-2xl font-bold mb-4 text-black">Femme</h2>
                            <img id="fleche-femme" class="w-4 h-4 mt-2.5 ml-6.5" src="{{ asset('fleche-liste.png') }}" alt="">
                        </div>
                        <ul id="liste_femme" class="space-y-2 hidden mb-5">
                            @foreach ($categoriesFemme as $category)
                            <li><a href="{{ route('produits.categorie', ['id' => $category->id]) }}" class="text-black">{{ $category->nom }}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Homme -->
                    <div class=" rounded-2xl ml-22.5 mb-[700px]">
                        <div id="homme" class="flex  cursor-pointer">
                            <h2 class="text-2xl font-bold mb-4 text-black">Homme</h2>
                            <img id="fleche-homme" class="w-4 h-4 mt-2.5 ml-5" src="{{ asset('fleche-liste.png') }}" alt="">
                        </div>
                        <ul id="liste_homme" class="space-y-2 hidden">
                            @foreach ($categoriesHomme as $category)
                            <li><a href="{{ route('produits.categorie', ['id' => $category->id]) }}" class="text-black">{{ $category->nom }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <a href="/" class="md:!w-[100px] md:!h-[70px] md:mt-5 md:ml-22 mt-6 ml-8"><img id="logo" src="{{ asset('Shiny2.png') }}" alt="logo" class="md:!w-[100px] md:!h-[65px] !w-[60px] !h-[25px]"></a>

                <div class="flex items-center space-x-4 mt-5">
                    <img src="{{ asset('utilisateur.png') }}" alt="utilisateur" class="md:w-6 md:h-6 md:mr-6 w-5 h-5 mr-1" id="utilisateur_icon">
                    <div id="login_page" class="absolute mt-5 hidden">
                        @guest
                        <p class="absolute rotate-270 text-2xl  text-white "> ▶</p>
                        <div class="absolute mt-5 md:right-[-147px] right-[47px] text-black bg-white w-[280px] h-auto md:p-4 p-1 rounded-[20px] flex-col text-center content-center">
                            <h1 class="text-xl font-bold">Bienvenue</h1>
                            <p class="md:text-sm text-xs">Connectez-vous pour profiter <br> l'expérience complète</p>
                            <a href="/loginpage">
                                <input type="button" value="Se connecter" class="bg-black text-white w-[200px] h-[50px] rounded-[20px] mt-4">
                            </a>
                        </div>
                        @else
                        <p class="absolute rotate-270 text-2xl  text-white "> ▶</p>
                        <div class="absolute mt-5 right-[-147px] text-black bg-white w-[280px] h-auto p-4 rounded-[20px] flex-col text-center">
                            <h1 class="text-xl font-bold text-center">Bonjour</h1>
                            <a href="{{ route('compte') }}">
                                <p class="text-start ml-6 mt-3">Mon compte</p>
                            </a>
                            <a href="{{ route('commandes.index') }}">
                                <p class="text-start ml-6">Mes commandes</p>
                            </a>
                            <hr class="border-gray-300 w-[80%] mx-auto mt-3 mb-1">
                            <a href="/logout">
                                <input type="button" value="Déconnexion" class="bg-black text-white w-[200px] h-[50px] rounded-[20px] mt-4">
                            </a>
                        </div>
                        @endguest
                    </div>

                    <a href="/favoris" class="mr-0.5 md:mr-4"><img src="{{ asset('favoris.png') }}" alt="favoris" class="md:w-6 md:h-6 md:mr-1 w-5 h-5"></a>
                    <a href="/panier"><img src="{{ asset('panier.png') }}" alt="panier" class="md:w-6 md:h-6 w-5 h-5"></a>
                </div>
            </div>
        </div>

        <div class="mt-[100px]">
            <button onclick="window.location = document.referrer">
                <img class="rotate-225 md:w-8 w-5 absolute mt-1" src="fleche-black.png" alt="">
                <h1 class="md:text-4xl text-xl font-bold md:ml-11 ml-5">Favoris</h1>
            </button>
        </div>
        <!-- Vos Favoris -->
        <div class="md:w-[90%] mx-auto mt-10">
            <div class="grid md:grid-cols-5 grid-cols-2 gap-1 bg-white md:rounded-[20px] rounded-[10px]">
                @forelse ($favoris as $product)
                <div class="bg-white rounded-lg  p-4 h-auto">
                    <a href="{{ route('produit.details', ['id' => $product->id]) }}">
                    <img src="{{ asset('storage/' . $product->firstPhoto->image_path) }}" class="md:w-[269px] md:h-[403px] md:rounded-[20px] rounded-[10px] object-cover"></a>
                    <div class="flex">
                        <a href="{{ route('produit.details', ['id' => $product->id]) }}">
                        <h2 class="mt-2 md:text-lg text-sm">{{ $product->nom }}</h2></a>
                        <img id="favori-{{ $product->id }}" class="self-start mt-2 mr-2 ml-auto md:w-[24px] w-[20px]" src="{{ auth()->user() && auth()->user()->favorites->contains($product->id) ? asset('favori.png') : asset('favoris.png') }}" alt="favoris" onclick="toggleFavori({{ $product->id }})">
                    </div>
                    <a href="{{ route('produit.details', ['id' => $product->id]) }}">
                    <div class="flex">
                        @for ($i = 1; $i <= 5; $i++)
                            <label>
                            <input type="radio" name="rating" value="{{ $i }}" class="hidden" onchange="this.form.submit()">
                            <svg class="md:w-5 md:h-5 h-4 h-4 cursor-pointer hover:text-black {{ value('rating') >= $i ? 'text-black' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.975h4.184c.969 0 1.371 1.24.588 1.81l-3.388 2.46 1.286 3.975c.3.921-.755 1.688-1.54 1.118L10 13.347l-3.388 2.46c-.784.57-1.838-.197-1.539-1.118l1.286-3.975-3.388-2.46c-.784-.57-.38-1.81.588-1.81h4.184l1.286-3.975z" />
                            </svg>
                            </label>
                            @endfor
                            <p class="relative bottom-1 ml-1 md:text-lg text-sm">(5)</p>
                    </div>
                    <p class="text-lg font-semibold mt-1">{{ $product->prix }} MAD</p>
                    </a>
                </div>
                @empty
                <div class="col-span-5 text-center py-10">
                    <h1 class="text-2xl font-bold"> Tu n'as pas de favoris</h1>
                    <p class="text-gray-500 text-lg">Aucun produit dans vos favoris. </p>
                </div>
                @endforelse

            </div>
        </div>
    </div>



   <div class="bg-white mt-[10px] rounded-[20px] md:h-[400px] h-[710px] mb-[40px] w-[90%] relative mx-auto ">
        <div class="md:flex">
            <div class="relative md:top-10 md:left-5">
                <a href="/"><img id="logo" src="{{ asset('Shiny.svg') }}" alt="logo"></a>
                <p class="relative left-5 bottom-10 text-gray-600 mt-4">Transactions fluides, informations <br> personnalisées et solutions innovantes <br> pour un avenir plus intelligent.</p>
                <ul class="wrapper md:mt-5 mt-20 md:!w-[100%] !w-[45%]">
                    <li class="icon facebook">
                        <span class="tooltip">Facebook</span>
                        <svg
                            viewBox="0 0 320 512"
                            height="20px"
                            fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
                        </svg>
                    </li>
                    <li class="icon twitter">
                        <span class="tooltip">Twitter</span>
                        <svg
                            height="30px"
                            fill="currentColor"
                            viewBox="0 0 48 48"
                            xmlns="http://www.w3.org/2000/svg"
                            class="twitter">
                            <path
                                d="M42,12.429c-1.323,0.586-2.746,0.977-4.247,1.162c1.526-0.906,2.7-2.351,3.251-4.058c-1.428,0.837-3.01,1.452-4.693,1.776C34.967,9.884,33.05,9,30.926,9c-4.08,0-7.387,3.278-7.387,7.32c0,0.572,0.067,1.129,0.193,1.67c-6.138-0.308-11.582-3.226-15.224-7.654c-0.64,1.082-1,2.349-1,3.686c0,2.541,1.301,4.778,3.285,6.096c-1.211-0.037-2.351-0.374-3.349-0.914c0,0.022,0,0.055,0,0.086c0,3.551,2.547,6.508,5.923,7.181c-0.617,0.169-1.269,0.263-1.941,0.263c-0.477,0-0.942-0.054-1.392-0.135c0.94,2.902,3.667,5.023,6.898,5.086c-2.528,1.96-5.712,3.134-9.174,3.134c-0.598,0-1.183-0.034-1.761-0.104C9.268,36.786,13.152,38,17.321,38c13.585,0,21.017-11.156,21.017-20.834c0-0.317-0.01-0.633-0.025-0.945C39.763,15.197,41.013,13.905,42,12.429"></path>
                        </svg>
                    </li>
                    <li class="icon instagram">
                        <span class="tooltip">Instagram</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            height="20px"
                            fill="currentColor"
                            class="bi bi-instagram"
                            viewBox="0 0 16 16">
                            <path
                                d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
                        </svg>
                    </li>
                </ul>

            </div>

            <div class="grid md:grid-cols-3 md:gap-60 grid-cols-2 md:mt-20 md:ml-[250px] mt-18 ml-6 gap-x-30 gap-y-4">
                <div class="w-[200px]">
                    <h3 class="font-semibold mb-3">Entreprise</h3>
                    <ul class="text-gray-700 space-y-2">
                        <li><a href="/about" class="text-xs md:text-[16px]">À propos de Shiny</a></li>
                        <li><a href="/politique_cookies" class="text-xs md:text-[16px]">Politique de cookies</a></li>
                        <li><a href="/politique_conf" class="text-xs md:text-[16px]">Politique de confidentialité</a></li>


                    </ul>
                </div>

                <div>
                    <h3 class="font-semibold mb-3">Aide</h3>
                    <ul class="text-gray-700 space-y-2">
                        <li><a href="/aide/retour" class="text-xs md:text-[16px]">Retours</a></li>
                        <li><a href="/aide/livraison" class="text-xs md:text-[16px]">Livraison</a></li>
                        <li><a href="/aide/paiement" class="text-xs md:text-[16px]">Paiement</a></li>
                        <li><a href="/contact" class="text-xs md:text-[16px]">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-semibold mb-3">Menu</h3>
                    <ul class="text-gray-700 space-y-2">
                        <li><a href="#" class="text-xs md:text-[16px]">Hommes</a></li>
                        <li><a href="#" class="text-xs md:text-[16px]">Femmes</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="border-gray-300 w-[94%] flex mx-auto mt-20">
        <div class="pt-6 w-[90%] mx-auto flex flex-row justify-between text-sm text-gray-600">

            <p class="text-xs md:text-[14px] md:ml-0 ml-23">Copyright © 2025 Shiny</p>
            <a href="/politique_conf" class="mt-0 hover:underline md:block hidden">Politique de confidentialité</a>
        </div>
    </div>


    <script>


        function toggleFavori(productId) {
            fetch(`/favori/toggle/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    const img = document.getElementById('favori-' + productId);
                    img.src = data.favori ?
                        "{{ asset('favori.png') }}" :
                        "{{ asset('favoris.png') }}";

                    window.location.reload();
                });
        }

        
    </script>
</body>

</html>
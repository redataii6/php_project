<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-10">
    <title>Panier - Shiny</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/css/home_page.css')
    @vite('resources/js/app.js')
    <style>
        .inputGroup {
            font-family: 'Segoe UI', sans-serif;
            margin: 1em 0 1em 0;
            position: relative;
        }

        .inputGroup input {
            font-size: 100%;
            padding: 0.8em;
            outline: none;
            border: 1px solid rgb(200, 200, 200);
            background-color: transparent;
            border-radius: 10px;
            width: 100%;
        }

        .inputGroup label {
            font-size: 100%;
            position: absolute;
            left: 0;
            padding: 0.8em;
            margin-left: 0.5em;
            pointer-events: none;
            transition: all 0.3s ease;
            color: rgb(100, 100, 100);
        }

        .inputGroup :is(input:focus, input:valid)~label {
            transform: translateY(-50%);
            margin: 0em;
            margin-left: 1.3em;
            padding: 0.4em;
            color: rgb(0, 0, 0);
            background-color: rgb(255, 255, 255);
        }

        .inputGroup :is(input:focus, input:valid),
        .container:has(input:focus),
        .container:has(input:valid) {
            border: 1px solid rgb(0, 0, 0);
        }



        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 270px;
            height: 50px;
            border-radius: 10px;
            position: relative;
            border: 1px solid rgb(200, 200, 200);
        }

        .prefix {
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgb(0, 0, 0);
            font-size: 15px;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            height: 100%;
            width: 70px;
            font-weight: 400;
            padding: 10px;
            background-color: rgb(255, 255, 255);
            border-radius: 10px 0px 0px 10px;
        }

        .myinput-link {
            display: flex;
            align-items: start;
            justify-content: start;
            outline: none;
            font-weight: 500;
            border: none;
            border-radius: 0px 10px 10px 0px;
            padding: 0px 10px;
            height: 100%;
            width: 200px;
            background-color: #fff;
            font-size: 15px;
        }

        .container input:focus+label,
        .container input:valid+label {
            transform: translateY(-70%) scale(.9);
            margin: 0em;
            margin-left: 1.3em;
            padding: 0.4em;
            color: rgb(0, 0, 0);
            background-color: rgb(255, 255, 255);
        }
    </style>
</head>

<body>
    <div id="overflow" class="hidden bg-gray-700 opacity-25  h-[100%] w-[100%] fixed  z-50"></div>
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
                <h1 class="md:text-4xl text-xl font-bold md:ml-11 ml-5">Panier</h1>
            </button>
        </div>
        <div class="md:flex mb-15">
            <div class="md:w-[70%] md:rounded-[20px] rounded-[10px] mt-8 bg-white">
                @forelse ($articles as $article)
                <div class="p-6 flex mb-4">
                    <a href="{{ route('produit.details', ['id' => $article->produit_id]) }}">
                    <img src="{{ asset('storage/' . $article->produit->image?->image_path) }}" class="md:w-[269px] md:h-[403px] w-[134px] h-[172px] rounded-[20px] object-cover"></a>
                    <div class="ml-6">
                        <h3 class="md:text-xl ">{{ $article->produit->nom }}</h3>
                        <p class="md:text-2xl font-bold mt-2">{{ number_format($article->produit->prix, 2) }} MAD</p>
                        <div class="flex md:mt-10">
                            <p class="text-sm font-normal">Couleur Sélectionnée :</p>
                            <a href="{{ route('produit.details', ['id' => $article->produit_id]) }}" class="md:mt-[-7px]">
                            <button
                                class="w-5 h-5  rounded-full border border-black md:ml-3 mt-5 md:mt-[-10px]"
                                style="background-color: {{ $article->productColor->hex_code }};">
                            </button>
                            </a>
                        </div>
                        <div class="flex mt-1">
                            <p class=" text-sm font-normal mt-1">Taille Sélectionnée :</p>
                            <a href="{{ route('produit.details', ['id' => $article->produit_id]) }}">
                            <p class="md:ml-3 font-bold mt-5 md:mt-0">{{ $article->productSize->size }}</p>
                            </a>
                        </div>
                        <div class="flex items-center mt-4">
                            <form method="POST" action="{{ route('panier.decrementer', $article->id) }}">
                                @csrf
                                <button class="border rounded-full md:w-8 md:h-8 w-6 h-6">-</button>
                            </form>
                            <span class="mx-4">{{ $article->quantite }}</span>
                            <form method="POST" action="{{ route('panier.incrementer', $article->id) }}">
                                @csrf
                                <button class="border rounded-full md:w-8 md:h-8 w-6 h-6">+</button>
                            </form>
                        </div>
                        <form method="POST" action="{{ route('panier.supprimer', $article->id) }}" class="mt-6">
                            @csrf
                            @method('DELETE')
                            <button class="mt-6 text-red-600 flex items-center">
                                <img src="trash-icon.png" class="md:w-4 md:h-4 w-3 h-3 mr-2">
                                Supprimer
                            </button>
                        </form>
                    </div>

                </div>
                <hr class="border-gray-300 w-[90%] mx-auto">
                @empty
                <p class="p-6 text-center">Votre panier est vide.</p>
                @endforelse
            </div>
            <div class="md:w-[30%] h-[555px] bg-white rounded-[20px] mt-8 md:ml-4 md:p-6 p-3">
                <div class="p-4">
                    <div class="flex justify-between text-lg font-normal text-gray-600">
                        <span>Sous-Total:</span>
                        <span>{{ $sousTotal }} MAD</span>
                    </div>
                    <div class="flex justify-between text-lg font-normal mt-5 text-gray-600">
                        <span>Livraison:</span>
                        <span>{{ $livraison }} MAD</span>
                    </div>
                    <hr class="border-gray-300 w-[100%] mx-auto mt-8">
                    <div class="flex justify-between text-xl font-bold mt-5 ">
                        <span>Total:</span>
                        <span>{{ $total }} MAD</span>
                    </div>
                </div>

                <div class="flex justify-end mt-8">
                    <button id="open-form" class="bg-black text-white rounded-full px-8 py-3 flex items-center hover:bg-gray-800 transition-colors" {{ count($articles) === 0 ? 'disabled' : '' }}>
                        Commander
                        <img src="fleche.png" class="w-4 h-4 ml-2">
                    </button>
                </div>
                @if (session('error'))
                <div class="flex items-center mt-4">
                    <img style="width:15px; height:15px; position:relative; left:5px; top:-1.5px;" src="{{ asset('exclamation.png') }}" alt="">
                    <p style="font-size:15px; color:red; margin: 0; margin-left:10px;">{{ session('error') }}</p>
                </div>
                @endif
                <div class="md:p-4 p-2">
                    <h2 class="text-xl font-bold">Nous acceptons :</h2>
                    <div class="flex mt-4">
                        <img src="https://js.stripe.com/v3/fingerprinted/img/visa-729c05c240c4bdb47b03ac81d9945bfe.svg" class="w-12 h-7 ">
                        <img src="https://js.stripe.com/v3/fingerprinted/img/mastercard-4d8844094130711885b5e41b28c9848f.svg" class="w-12 h-7 ">
                        <img src="https://js.stripe.com/v3/fingerprinted/img/amex-a49b82f46c5cd6a96a6e418a6ca1717c.svg" class="w-12 h-7 ">
                        <img src="https://js.stripe.com/v3/fingerprinted/img/jcb-271fd06e6e7a2c52692ffa91a95fb64f.svg" class="w-12 h-7 ">
                        <img src="https://js.stripe.com/v3/fingerprinted/img/discover-ac52cd46f89fa40a29a0bfb954e33173.svg" class="w-12 h-7 ">
                        <img src="https://js.stripe.com/v3/fingerprinted/img/diners-fbcbd3360f8e3f629cdaa80e93abdb8b.svg" class="w-12 h-7 ">
                        <img class="w-10.5 h-7 md:absolute md:ml-72.5 border border-stone-300 rounded-[3px]" src="cash.png" alt="">
                    </div>
                </div>
                <div class="p-4">
                    <p class="text-sm text-gray-500 mt-2">
                        Paiement sécurisé fourni par <strong class="text-gray-900">Stripe</strong>, une solution de paiement reconnue mondialement.
                    </p>
                    <p class="text-sm text-gray-500 mt-2">
                        En payant par carte, vous acceptez la <a href="https://stripe.com/privacy" target="_blank" class="text-gray-900 underline"><strong>Politique de confidentialité</strong></a> de Stripe.
                    </p>
                </div>
            </div>
        </div>

    </div>
    <!-- Formulaire flottant -->
    <div id="formulaire-overlay" class="fixed inset-0 hidden flex justify-center items-center z-50 ">
        <div class="bg-white p-8 rounded-2xl md:h-[700px] md:w-[680px] relative">
            <button id="close-form" class="absolute top-2 right-3 text-xl font-bold">&times;</button>

            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <h2 class="md:text-2xl font-semibold mb-4">Informations sur le destinataire</h2>
                <div class="flex justify-between">
                    <div class="flex inputGroup">
                        <input class="md:!w-[300px]" type="text" name="nom" required>
                        <label for="nom">Nom</label>
                    </div>
                    <div class="flex inputGroup">
                        <input class="md:!w-[300px]" type="text" name="prenom" required>
                        <label for="prenom">Prenom</label>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="flex inputGroup">
                        <input class="md:!w-[300px]" type="text" name="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="container md:!w-[300px] !w-[160px] md:!h-[52px] mt-4">
                        <span class="prefix">+212</span>
                        <input class="myinput-link md:!w-[300px]" name="tel" required />
                        <label style="transition: all 0.3s ease;" for="tel" class="absolute md:ml-20 ml-15 pointer-events-none">Telephone</label>
                    </div>

                </div>

                <h2 class="md:text-2xl font-semibold mb-4 mt-5">Adresse d'expédition</h2>
                <div class="flex inputGroup">
                    <input type="text" name="adresse" required>
                    <label for="email">Rue et numéro et étage</label>
                </div>
                <div class="container md:!w-[300px] !w-[320px] mt-5">
                    <span class="prefix">Ville</span>
                    <select class="myinput-link" name="ville" required>
                        <option></option>
                        <optgroup label="Casablanca-Settat">
                            <option value="Benslimane">Benslimane</option>
                            <option value="Berrechid">Berrechid</option>
                            <option value="Casablanca">Casablanca</option>
                            <option value="El Jadida">El Jadida</option>
                            <option value="Mohammédia">Mohammédia</option>
                            <option value="Settat">Settat</option>
                            <option value="Sidi Bennour">Sidi Bennour</option>
                        </optgroup>
                        <optgroup label="Rabat-Salé-Kénitra">
                            <option value="Kénitra">Kénitra</option>
                            <option value="Khémisset">Khémisset</option>
                            <option value="Rabat">Rabat</option>
                            <option value="Salé">Salé</option>
                            <option value="Sidi Kacem">Sidi Kacem</option>
                            <option value="Sidi Slimane">Sidi Slimane</option>
                            <option value="Skhirat-Témara">Skhirat-Témara</option>
                            <option value="Tiflet">Tiflet</option>
                        </optgroup>
                        <optgroup label="Tanger-Tétouan-Al Hoceïma">
                            <option value="Al Hoceïma">Al Hoceïma</option>
                            <option value="Chefchaouen">Chefchaouen</option>
                            <option value="Fahs-Anjra">Fahs-Anjra</option>
                            <option value="Fnideq">Fnideq</option>
                            <option value="Larache">Larache</option>
                            <option value="M'diq">M'diq</option>
                            <option value="Martil">Martil</option>
                            <option value="Ouezzane">Ouezzane</option>
                            <option value="Tanger">Tanger</option>
                            <option value="Tétouan">Tétouan</option>
                        </optgroup>
                        <optgroup label="Marrakech-Safi">
                            <option value="Al Haouz">Al Haouz</option>
                            <option value="Chichaoua">Chichaoua</option>
                            <option value="El Kelâa des Sraghna">El Kelâa des Sraghna</option>
                            <option value="Essaouira">Essaouira</option>
                            <option value="Marrakech">Marrakech</option>
                            <option value="Rehamna">Rehamna</option>
                            <option value="Safi">Safi</option>
                            <option value="Youssoufia">Youssoufia</option>
                        </optgroup>
                        <optgroup label="Fès-Meknès">
                            <option value="Boulemane">Boulemane</option>
                            <option value="El Hajeb">El Hajeb</option>
                            <option value="Fès">Fès</option>
                            <option value="Ifrane">Ifrane</option>
                            <option value="Meknès">Meknès</option>
                            <option value="Moulay Yaâcoub">Moulay Yaâcoub</option>
                            <option value="Sefrou">Sefrou</option>
                            <option value="Taza">Taza</option>
                        </optgroup>
                        <optgroup label="Béni Mellal-Khénifra">
                            <option value="Azilal">Azilal</option>
                            <option value="Béni Mellal">Béni Mellal</option>
                            <option value="Fquih Ben Salah">Fquih Ben Salah</option>
                            <option value="Khénifra">Khénifra</option>
                            <option value="Khouribga">Khouribga</option>
                        </optgroup>
                        <optgroup label="Oriental">
                            <option value="Berkane">Berkane</option>
                            <option value="Driouch">Driouch</option>
                            <option value="Figuig">Figuig</option>
                            <option value="Guercif">Guercif</option>
                            <option value="Jerada">Jerada</option>
                            <option value="Nador">Nador</option>
                            <option value="Oujda">Oujda</option>
                            <option value="Taourirt">Taourirt</option>
                        </optgroup>
                        <optgroup label="Drâa-Tafilalet">
                            <option value="Errachidia">Errachidia</option>
                            <option value="Midelt">Midelt</option>
                            <option value="Ouarzazate">Ouarzazate</option>
                            <option value="Tinghir">Tinghir</option>
                            <option value="Zagora">Zagora</option>
                        </optgroup>
                        <optgroup label="Souss-Massa">
                            <option value="Agadir">Agadir</option>
                            <option value="Inezgane-Aït Melloul">Inezgane-Aït Melloul</option>
                            <option value="Chtouka-Aït Baha">Chtouka-Aït Baha</option>
                            <option value="Taroudant">Taroudant</option>
                            <option value="Tiznit">Tiznit</option>
                        </optgroup>
                        <optgroup label="Laâyoune-Sakia El Hamra">
                            <option value="Boujdour">Boujdour</option>
                            <option value="Laâyoune">Laâyoune</option>
                            <option value="Tarfaya">Tarfaya</option>
                        </optgroup>
                        <optgroup label="Dakhla-Oued Ed-Dahab">
                            <option value="Aousserd">Aousserd</option>
                            <option value="Dakhla">Dakhla</option>
                        </optgroup>
                    </select>
                </div>

                <h2 class="md:text-2xl font-semibold mb-4 mt-5">Choisis un mode de paiement</h2>
                <div class="flex flex-row justify-between">
                    <!-- Option Carte bancaire -->
                    <label id="label1" class="flex items-center p-4 border-2 border-primary md:w-[48%] rounded-[10px] cursor-pointer bg-white">
                        <input type="radio" name="payment" class="hidden" value="card" checked>
                        <span class="font-semibold">Carte bancaire</span>
                        <svg version="1.1" viewBox="0 0 96 64" class="svg-icon svg-fill w-8 h-7 absolute ml-56 md:inline-block hidden">
                            <path pid="0" d="M2.5 2.5L0 4.9v54.2l2.5 2.4L4.9 64h86.2l2.4-2.5 2.5-2.4V4.9l-2.5-2.4L91.1 0H4.9L2.5 2.5zm88.3 2.7c.7.7 1.2 3.6 1.2 6.5V17H4v-5.3c0-2.9.5-5.8 1.2-6.5 1.7-1.7 83.9-1.7 85.6 0zM92 43.8c0 9.4-.4 14.2-1.2 15-1.7 1.7-83.9 1.7-85.6 0-.8-.8-1.2-5.6-1.2-15V30h88v13.8z"></path>
                        </svg>
                    </label>

                    <!-- Option PayOnDelivery -->
                    <label id="label2" class="flex items-center p-4 border border-gray-300 w-[48%] rounded-[10px] cursor-pointer bg-white ">
                        <input type="radio" name="payment" class="hidden" value="delivery">
                        <span class="font-semibold">PayOnDelivery</span>
                        <img class="w-8 h-6 absolute ml-56 md:inline-block hidden" src="https://static.bershka.net/4/static/images/payment/16.png?t=20250509020703" alt="">
                    </label>
                </div>
                <button type="submit" class="bg-black text-white px-4 py-2 rounded-full w-full hover:bg-gray-800 mt-8">
                    Valider la commande
                </button>
            </form>
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
        const openFormBtn = document.getElementById('open-form');
        const closeFormBtn = document.getElementById('close-form');
        const overlay = document.getElementById('formulaire-overlay');
        const overflow = document.getElementById('overflow');
        openFormBtn.addEventListener('click', () => {
            overlay.classList.remove('hidden');
            overflow.classList.remove('hidden');
        });

        closeFormBtn.addEventListener('click', () => {
            overlay.classList.add('hidden');
            overflow.classList.add('hidden');
        });

        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) {
                overlay.classList.add('hidden');
                overflow.classList.add('hidden');
            }
        });


        const label1 = document.getElementById('label1');
        const label2 = document.getElementById('label2');
        label1.addEventListener('click', () => {
            label1.classList.add('border-2', 'border-primary');
            label1.classList.remove('border', 'border-gray-300');
            label2.classList.add('border', 'border-gray-300');
            label2.classList.remove('border-2', 'border-primary');
        });

        label2.addEventListener('click', () => {
            label2.classList.add('border-2', 'border-primary');
            label2.classList.remove('border', 'border-gray-300');
            label1.classList.add('border', 'border-gray-300');
            label1.classList.remove('border-2', 'border-primary');
        });
    </script>
</body>

</html>
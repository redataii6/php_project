<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/css/home_page.css')
    @vite('resources/js/app.js')

</head>

<body>
    <div id="container" class="!h-[400px]">
        <div id="language" class="fixed top-0 w-[90%] z-50 px-2">
            <p>MOROCCO | MAD | FRENCH</p>
        </div>
        <div style="background-color: rgb(245, 246, 247);" id="navbar" class="fixed top-[-15px] w-[90%] z-40  px-2">
            <div class="w-[100%] flex justify-between items-center h-[100px] ">
                <img id="menu" src="{{ asset('menu.png') }}" alt="menu" class="w-8 h-8 z-50 cursor-pointer">
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
                <a href="/" class="!w-[100px] !h-[70px] mt-5 ml-22"><img id="logo" src="{{ asset('Shiny2.png') }}" alt="logo" class="!w-[100px] !h-[65px] "></a>

                <div class="flex items-center space-x-4 mt-5">
                    <img src="{{ asset('utilisateur.png') }}" alt="utilisateur" class="w-6 h-6 mr-6" id="utilisateur_icon">
                    <div id="login_page" class="absolute mt-5 hidden">
                        @guest
                        <p class="absolute rotate-270 text-2xl  text-white "> ▶</p>
                        <div class="absolute mt-5 right-[-147px] text-black bg-white w-[280px] h-auto p-4 rounded-[20px] flex-col text-center content-center">
                            <h1 class="text-xl font-bold">Bienvenue</h1>
                            <p class="text-sm">Connectez-vous pour profiter <br> l'expérience complète</p>
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

                    <a href="/favoris"><img src="{{ asset('favoris.png') }}" alt="favoris" class="w-6 h-6 mr-1"></a>
                    <a href="/panier"><img src="{{ asset('panier.png') }}" alt="panier" class="w-6 h-6"></a>
                </div>
            </div>
        </div>
        <div class="rounded-[30px] flex justify-center items-center mt-[250px]" id="first-picture">
            <div class="bg-black/40 rounded-[20px] w-[100%] h-[500px] absolute"></div>
            <img class="mask-radial-at-center !h-[500px]" src="{{ asset('a_propos_pic.png') }}" alt="">
            <h1 style="font-family: 'Poetsen One', sans-serif;" class="absolute text-white text-8xl ">Retours</h1>
        </div>
    </div>




    <div class="max-w-4xl mx-auto p-6">
        <pre style="font-family: 'Poetsen One', sans-serif;" class="text-2xl flex justify-center text-center">❝   Chez Shiny, nous voulons rendre votre expérience aussi simple que possible. <br>  Si un article ne vous convient pas, vous pouvez le retourner facilement <br> grâce à notre service d’enlèvement à domicile.   ❞</pre>
        <h2 class="text-2xl font-semibold mb-4 mt-15">Comment retourner un article ?</h2>
        <p class="mb-3">Nous proposons uniquement un retour à domicile :</p>
        <ul class="list-disc list-inside mb-6 space-y-2 ml-6">
            <li>Connectez-vous à votre compte client sur notre site.</li>
            <li>Accédez à la section « Mes commandes » puis « Retourner un article ».</li>
            <li>Remplissez la demande de retour en indiquant l’adresse d’enlèvement.</li>
            <li>Un transporteur viendra récupérer votre colis directement à l’adresse indiquée.</li>
        </ul>
        <p class="mb-6">Les articles doivent être retournés dans leur état d'origine, non utilisés, avec les étiquettes encore attachées, dans leur emballage d’origine, accompagnés du reçu ou de la facture disponible dans votre compte.</p>

        <h2 class="text-2xl font-semibold mb-4">Comment vais-je recevoir mon remboursement ?</h2>
        <p class="mb-6">Une fois votre retour approuvé, nous procéderons au remboursement via le même moyen de paiement que celui utilisé lors de votre achat. <br>Pour les commandes à paiement à la livraison, veuillez remplir vos coordonnées bancaires lors de la demande de retour pour un virement bancaire.</p>

        <h2 class="text-2xl font-semibold mb-4">Quand recevrai-je mon remboursement ?</h2>
        <p class="mb-6">Après réception et validation de votre retour, vous recevrez une confirmation par e-mail. Le remboursement sera ensuite effectué sous quelques jours, selon les délais de votre banque ou service de paiement.</p>

        <h2 class="text-2xl font-semibold mb-4">Que faire si un montant incorrect m’est remboursé ?</h2>
        <p class="mb-6">Si vous constatez une erreur dans le montant remboursé, contactez notre service client. Nous réglerons cela rapidement.</p>

        <h2 class="text-2xl font-semibold mb-4">Puis-je annuler un article ou une commande ?</h2>
        <p class="mb-6">Avant validation du paiement, vous pouvez modifier votre panier à tout moment. Après validation, rendez-vous dans « Mon compte » puis « Historique des commandes » pour demander l'annulation.</p>

        <p class="text-sm text-center">Shiny se réserve le droit de refuser tout retour en dehors du délai de 10 jours suivant <br> l’expédition ou d’articles ne respectant pas nos conditions de retour.</p>
    </div>






    <div class="bg-white mt-[10px] rounded-[20px] h-[400px] mb-[40px] w-[90%] relative mx-auto ">
        <div class="flex">
            <div class="relative top-10 left-5">
                <a href="/"><img id="logo" src="{{ asset('Shiny.svg') }}" alt="logo"></a>
                <p class="relative left-5 bottom-10 text-gray-600 mt-4">Transactions fluides, informations <br> personnalisées et solutions innovantes <br> pour un avenir plus intelligent.</p>
                <ul class="wrapper mt-5">
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

            <div class="grid md:grid-cols-3 gap-60 mt-20 ml-[250px]">
                <div class="w-[200px]">
                    <h3 class="font-semibold mb-3">Entreprise</h3>
                    <ul class="text-gray-700 space-y-2">
                        <li><a href="/about">À propos de Shiny</a></li>
                        <li><a href="/politique_cookies">Politique de cookies</a></li>
                        <li><a href="/politique_conf">Politique de confidentialité</a></li>
                        
                        
                    </ul>
                </div>

                <div>
                    <h3 class="font-semibold mb-3">Aide</h3>
                    <ul class="text-gray-700 space-y-2">
                        <li><a href="/aide/retour">Retours</a></li>
                        <li><a href="/aide/livraison">Livraison</a></li>
                        <li><a href="/aide/paiement">Paiement</a></li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-semibold mb-3">Menu</h3>
                    <ul class="text-gray-700 space-y-2">
                        <li><a href="#">Hommes</a></li>
                        <li><a href="#">Femmes</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="border-gray-300 w-[94%] flex mx-auto mt-20">
        <div class="pt-6 w-[90%] mx-auto flex md:flex-row justify-between text-sm text-gray-600">

            <p>Copyright © 2025 Shiny</p>
            <a href="/politique_conf" class="mt-2 md:mt-0 hover:underline">Politique de confidentialité</a>
        </div>
    </div>
</body>

</html>
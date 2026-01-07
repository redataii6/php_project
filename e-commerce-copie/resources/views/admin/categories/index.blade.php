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
    <div id="overflow" class="hidden bg-gray-700 opacity-25  h-[100%] w-[100%] fixed  z-50"></div>
    <div class="flex w-full">
        <div class="sidebar fixed">
            <ul class="nav">
                <li id="tophome">
                    <a href="{{ route('admin.index')}}">
                        <img class="logos home" src="{{ asset('dashboard.png') }}" alt="">
                        <img class="logos home hv" src="{{ asset('dashboard_hv.png') }}" alt=""> Home</a>
                </li>
                <li>
                    <a href="{{ route('admin.produits.index')}}">
                        <img class="logos formateur " src="{{ asset('shirt.png') }}" alt="">
                        <img class="logos formateur hv " src="{{ asset('shirt_hv.png') }}" alt="">Produits</a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}" class="active">
                        <img class="logos stagiaire hidden" src="{{ asset('collection.png') }}" alt="">
                        <img class="logos stagiaire hv !block" src="{{ asset('collection_hv.png') }}" alt="">Collections</a>
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
                    <h1 class=" font-extrabold text-5xl mb-5 ml-5" style="font-family: 'Apple Chancery';">Catégories</h1>
                    <input id="toggleFormBtn"
                        class="float-end py-3 px-4 font-semibold text-white text-center border bg-black rounded-[10px]"
                        type="button" value="+ Ajouter catégorie">
                </div>
                <p class="ml-16">Utilisez le filtre pour effectuer une recherche plus rapide.</p>
                <form method="GET" action="{{ route('admin.categories.index') }}" class="mt-8">
                    @csrf
                    <div class="flex space-x-4 ml-80">
                        <div class="relative h-11 w-full max-w-[300px]">
                            <input id="nomF" name="nomF"
                                class="h-full w-full border-b border-gray-400 bg-transparent pt-4 pb-1.5  text-sm font-normal text-blue-gray-700 focus:border-gray-900 focus:outline-0  " />
                            <label
                                class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full text-sm font-normal  text-gray-900 ">
                                Nom
                            </label>
                        </div>
                        <div class="relative h-11 w-full  max-w-[300px]">
                            <label for="sexeF"
                                class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full text-sm font-normal  text-gray-900 ">
                                Sexe
                            </label>
                            <div class="sm:col-span-3">
                                <div class="relative h-11 w-full max-w-[300px]">
                                    <select id="sexeF" name="sexeF"
                                        class=" h-full w-full border border-gray-400 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  focus:border-1 focus:border-black focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent ">
                                        <option></option>
                                        <option value="homme">Homme</option>
                                        <option value="femme">Femme</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mb-16 mt-8 mr-42">
                        <a href="{{ route('admin.categories.index') }}" class="mr-5 mt-2 font-medium">Réinitialiser</a>
                        <button type="submit"
                            class=" rounded-md  px-3 py-2 text-sm font-semibold text-white shadow-sm  bg-black">Filtrer</button>
                    </div>

                </form>
                <div id="modalForm" class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-lg shadow-lg z-50 w-[400px]">
                    <form id="addCategoryForm" action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="flex inputGroup">
                            <input type="text" name="nom" id="nom" class="form-control !w-[400px]" required maxlength="255">
                            <label for="nom" class="form-label !bg-white mt-[1px]">Nom</label>
                        </div>
                        <div class="container !w-[350px] mt-4">
                            <span class="prefix form-label !ml-2 !text-gray-600 !bg-white" for="sexe">Sexe</span>
                            <select class="myinput-link form-select !bg-white " name="sexe" id="sexe" required>
                                <option></option>
                                <option value="homme">Homme</option>
                                <option value="femme">Femme</option>
                            </select>
                        </div>
                        <div class="flex justify-end items-center mt-5">
                            <p id="cancelFormBtn" class="text-red-700 font-semibold mr-4">Annuler</p>
                            <button type="submit" class="float-end py-2 px-3 font-semibold text-white text-center border bg-black rounded-[10px]">Ajouter</button>
                        </div>
                    </form>
                </div>

                <div class="relative overflow-hidden bg-white w-[70%] shadow-md rounded-lg mx-auto  mb-16">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-white uppercase bg-black">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Nom</th>
                                    <th scope="col" class="px-4 py-3">Sexe</th>
                                    <th scope="col" class="px-4 py-3">Produits</th>
                                    <th scope="col" class="px-4 py-3"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $categorie)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $categorie->nom }}</td>
                                    <td class="px-4 py-2">{{ $categorie->sexe }}</td>
                                    <td class="px-4 py-2">{{ $categorie->produits_count }}</td>
                                    <td class="px-4 py-2 w-[10%]">
                                        <div class="flex space-x-2">
                                            <button type="button" class="text-blue-500 open-modif-btn"
                                                data-id="{{ $categorie->id }}"
                                                data-nom="{{ $categorie->nom }}"
                                                data-sexe="{{ $categorie->sexe }}">
                                                <img class="w-5 h-5 mt-0.5" src="{{ asset('stylo.png') }}" alt="Modifier">
                                            </button>
                                            <form action="{{ route('admin.categories.delete', $categorie->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900"><img class="w-6 h-6" src="{{ asset('effacer.png') }}" alt=""></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div id="modifForm" class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-lg shadow-lg z-50 w-[400px]">
                            <form id="modifCategoryForm" method="POST">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label for="nom">Nom :</label>
                                    <input type="text" id="modifNom" name="nom" class="border rounded p-2 w-full">
                                </div>

                                <div>
                                    <label for="sexe">Sexe :</label>
                                    <select id="modifSexe" name="sexe" class="border rounded p-2 w-full">
                                        <option value="homme">Homme</option>
                                        <option value="femme">Femme</option>
                                    </select>
                                </div>

                                <div class="flex justify-between items-center mt-4">
                                    <button type="submit" class="bg-black text-white px-4 py-2 rounded">Mettre à jour</button>
                                    <button type="button" id="closeModifForm" class="text-red-600">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



            </div>


            <script>
                const toggleBtn = document.getElementById('toggleFormBtn');
                const cancelBtn = document.getElementById('cancelFormBtn');
                const modal = document.getElementById('modalForm');
                const modifform = document.getElementById('modifForm');
                const modifBtn = document.getElementById('')
                const overlay = document.getElementById('overflow');

                toggleBtn.addEventListener('click', () => {
                    modal.classList.remove('hidden');
                    overlay.classList.remove('hidden');
                });

                cancelBtn.addEventListener('click', () => {
                    modal.classList.add('hidden');
                    overlay.classList.add('hidden');
                });

                // Fermer le modal si on clique sur le fond obscur
                overlay.addEventListener('click', () => {
                    modal.classList.add('hidden');
                    overlay.classList.add('hidden');
                });



                document.querySelectorAll('.open-modif-btn').forEach(button => {
                    button.addEventListener('click', () => {
                        const id = button.getAttribute('data-id');
                        const nom = button.getAttribute('data-nom');
                        const sexe = button.getAttribute('data-sexe');

                        // Remplir le formulaire avec les données de la catégorie
                        document.getElementById('modifNom').value = nom;
                        document.getElementById('modifSexe').value = sexe;

                        const form = document.getElementById('modifCategoryForm');
                        form.action = `/admin/categories/${id}/update`;

                        // Afficher le formulaire
                        document.getElementById('modifForm').classList.remove('hidden');
                        overlay.classList.remove('hidden');
                    });
                });

                // Bouton de fermeture
                document.getElementById('closeModifForm').addEventListener('click', () => {
                    document.getElementById('modifForm').classList.add('hidden');
                    overlay.classList.add('hidden');
                });
                overlay.addEventListener('click', () => {
                    document.getElementById('modifForm').classList.add('hidden');
                    overlay.classList.add('hidden');
                });
            </script>


</body>

</html>
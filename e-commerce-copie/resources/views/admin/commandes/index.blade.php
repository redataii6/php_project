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
                        <img class="logos clients " src="{{ asset('customer.png') }}" alt="">
                        <img class="logos clients hv " src="{{ asset('customer_hv.png') }}" alt="">Client</a>
                </li>
                <li>
                    <a href="{{ route('admin.commandes.index') }}" class="active">
                        <img class="logos commandes hidden" src="{{ asset('box.png') }}" alt="">
                        <img class="logos commandes hv !block" src="{{ asset('box_hv.png') }}" alt="">Commandes</a>
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
                    <h1 class=" font-extrabold text-5xl mb-5 ml-5" style="font-family: 'Apple Chancery';">Commandes</h1>
                </div>
                <p class="ml-16">Utilisez le filtre pour effectuer une recherche plus rapide.</p>
                <form method="get" action="{{ route('admin.commandes.index') }}" class="mt-8">
                    @csrf
                    <div class="flex space-x-4 ml-40">
                        <div class="relative h-11 w-full max-w-[300px]">
                            <input id="id" name="id"
                                class="h-full w-full border-b border-gray-400 bg-transparent pt-4 pb-1.5  text-sm font-normal text-blue-gray-700 focus:border-gray-900 focus:outline-0  " />
                            <label
                                class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full text-sm font-normal  text-gray-900 ">
                                ID commande
                            </label>
                        </div>
                        <div class="relative h-11 w-full max-w-[300px]">
                            <input id="nom" name="nom"
                                class="h-full w-full border-b border-gray-400 bg-transparent pt-4 pb-1.5  text-sm font-normal text-blue-gray-700 focus:border-gray-900 focus:outline-0  " />
                            <label
                                class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full text-sm font-normal  text-gray-900 ">
                                Nom destinataire
                            </label>
                        </div>
                        <div class="relative h-11 w-full  max-w-[300px]">
                            <label for="ville"
                                class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full text-sm font-normal  text-gray-900 ">
                                Ville
                            </label>
                            <div class="sm:col-span-3">
                                <div class="relative h-11 w-full max-w-[300px]">
                                    <select name="ville" id="ville" class="peer h-full w-full border border-gray-400 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  focus:border-1 focus:border-black focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent ">
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
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-4 ml-120 mt-10">
                        <div class="relative h-11 w-full  max-w-[300px]">
                            <label for="paiement"
                                class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full text-sm font-normal  text-gray-900 ">
                                Paiement
                            </label>
                            <div class="sm:col-span-3">
                                <div class="relative h-11 w-full max-w-[300px]">
                                    <select id="paiement" name="paiement"
                                        class="peer h-full w-full border border-gray-400 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  focus:border-1 focus:border-black focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent ">
                                        <option value=""></option>
                                        <option value="en attente">en attente</option>
                                        <option value="payée">payée</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mb-16 mt-8 mr-22">
                        <a href="{{ route('admin.commandes.index') }}" class="mr-5 mt-2 font-medium">Réinitialiser</a>
                        <button type="submit"
                            class=" rounded-md  px-3 py-2 text-sm font-semibold text-white shadow-sm  bg-black">Filtrer</button>
                    </div>

                </form>
            </div>
            <div class="flex items-center mb-3">
                <form action="{{ route('admin.commandes.pdf') }}" method="POST" id="form-pdf">
                    @csrf
                    <div class="">
                        <button type="submit" class="text-white shadow-sm  bg-black px-4 py-[8px] rounded-md flex cursor-pointer border-2 border-black">
                            <img class="w-5 h-5" src="{{ asset('telechargements.png') }}" alt="">
                            <p class="ml-2 ">Liste de livraison</p>
                        </button>
                    </div>
                </form>
                <div class="ml-3">
                    <a href="{{ route('admin.commandes.historique') }}">
                        <button type="submit" class="text-black px-4 py-2 rounded-md flex cursor-pointer border-2 border-black">
                            <p class="">Historique</p>
                        </button>
                    </a>
                </div>
            </div>
            <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg mb-40">
                <div class="overflow-x-auto">

                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-white uppercase bg-black">
                            <tr>
                                <th scope="col" class="px-4 py-3 w-[3%]"></th>
                                <th scope="col" class="px-4 py-3 w-[3%]"></th>
                                <th scope="col" class="px-4 py-3">id</th>
                                <th scope="col" class="px-4 py-3">destinataire</th>
                                <th scope="col" class="px-4 py-3">Téléphone</th>
                                <th scope="col" class="px-4 py-3">ville</th>
                                <th scope="col" class="px-4 py-3">prix total</th>
                                <th scope="col" class="px-4 py-3">Paiement</th>
                                <th scope="col" class="px-4 py-3">Livraison</th>
                                <th scope="col" class="px-4 py-3 w-[3%]"></th>
                                <th></th>

                            </tr>

                        </thead>
                        @foreach ($commandes as $groupe => $listeCommandes)
                        <tbody>
                            <tr>
                                <td colspan="11" class="px-4 text-base font-bold text-black bg-gray-100 border-b border-t">
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" class="group-checkbox cursor-pointer" data-group="{{ \Illuminate\Support\Str::slug($groupe) }}">
                                        <span class="!ml-3">{{ $groupe }}</span>
                                    </label>
                                </td>
                            </tr>
                            @foreach ($listeCommandes as $commande)
                            <tr class="border-b" onclick="toggleItems({{ $commande->id }})">
                                <td class="px-4 py-2 font-medium text-gray-900 text-center" onclick="event.stopPropagation()">
                                    <input type="checkbox" name="commandes[]" value="{{ $commande->id }}" class="commande-checkbox cursor-pointer" data-group="{{ \Illuminate\Support\Str::slug($groupe) }}">
                                </td>
                                <td class="px-4 py-2 font-medium text-gray-900 w-[4%]"><img id="fleche-{{ $commande->id }}" class="h-4 w-4 transition-transform duration-200" src="{{ asset('fleche-liste.png') }}" alt=""></td>
                                <td class="px-4 py-2 font-medium text-gray-900"># {{ $commande->id }}</td>
                                <td class="px-4 py-2 font-medium text-gray-900">{{ $commande->nom }} {{ $commande->prenom }}</td>
                                <td class="px-4 py-2 font-medium text-gray-900">{{ $commande->tel }}</td>
                                <td class="px-4 py-2 font-medium text-gray-900">{{ $commande->ville }}</td>
                                <td class="px-4 py-2 font-medium text-gray-900">{{ $commande->total }} MAD</td>
                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($commande->statut == 'payée')
                                        <div class="inline-block w-4 h-4 mr-2 bg-green-500 rounded-full"></div>
                                        {{ $commande->statut }}
                                        @elseif($commande->statut == 'en attente')
                                        <div class="inline-block w-4 h-4 mr-2 bg-orange-500 rounded-full"></div>
                                        {{ $commande->statut }}
                                        @else
                                        <div class="inline-block w-4 h-4 mr-2 bg-red-500 rounded-full"></div>
                                        {{ $commande->statut }}
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($commande->livraison == 'livrée')
                                        <div class="inline-block w-4 h-4 mr-2 bg-green-500 rounded-full"></div>
                                        {{ $commande->livraison }}
                                        @elseif($commande->livraison == 'en attente')
                                        <div class="inline-block w-4 h-4 mr-2 bg-orange-500 rounded-full"></div>
                                        {{ $commande->livraison }}
                                        @else
                                        <div class="inline-block w-4 h-4 mr-2 bg-red-500 rounded-full"></div>
                                        {{ $commande->livraison }}
                                        @endif
                                    </div>
                                </td>
                                <td class="flex px-4 py-2 font-medium text-gray-900 w-[3%]" onclick="event.stopPropagation()">
                                    @if ($commande->livraison == 'en attente')
                                    <form action="{{ route('admin.commandes.livraison', $commande->id) }}" method="POST" onsubmit="event.stopPropagation()">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="px-2 py-1 bg-green-700 text-white rounded cursor-pointer">Livrée</button>
                                    </form>
                                    <form action="{{ route('admin.commandes.annuler', $commande->id) }}" method="POST" onsubmit="event.stopPropagation()">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="px-2 py-1 bg-red-700 text-white rounded ml-1 cursor-pointer">Annulée</button>
                                    </form>
                                    @endif

                                </td>
                                <td onclick="event.stopPropagation()">
                                    <form action="{{ route('admin.facture.pdf', $commande->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" style="border: none; background: none; padding: 0; margin: 0;" class="cursor-pointer" onsubmit="event.stopPropagation()">
                                            <img class="w-6 h-6" src="{{ asset('facture.png') }}" alt="Facture">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <tr class="border-b hidden" id="items-{{ $commande->id }}">
                                <td colspan="10" class="px-4 py-2 text-black">
                                    <div class="grid grid-cols-3 space-y-5">
                                        @foreach ($commande->commande_item as $item)
                                        <div class="flex">
                                            <img src="{{ asset('storage/' . $item->produit->firstPhoto->image_path) }}" class="w-[169px] h-[253px] object-cover rounded-md" alt="">
                                            <div>
                                                <p class="text-base font-semibold mt-2 ml-2">{{ $item->produit->nom }}</p>
                                                <p class="text-lg font-bold mt-2 ml-2">{{ $item->produit->prix }} MAD</p>
                                                <p class="text-base font-semibold mt-2 ml-3"><span class="text-sm text-gray-600">Catégorie : </span>{{ $item->produit->category->nom }}</p>
                                                <p class="text-base font-semibold mt-2 ml-3"><span class="text-sm text-gray-600">Taille : </span>{{ $item->taille->size }}</p>
                                                <div class="flex">
                                                    <span class="text-sm text-gray-600 font-semibold !ml-2 mt-2">Couleur : </span>
                                                    <div class="w-5 h-5 rounded-full border border-black mt-2 ml-2" style="background-color: {{ $item->couleur->hex_code }};"></div>
                                                    <p class="text-base font-semibold mt-1.5 ml-2">{{ $item->couleur->name }}</p>
                                                </div>
                                                <p class="text-base font-semibold mt-2 ml-3"><span class="text-sm text-gray-600">Quantité : </span>{{ $item->quantite }}</p>
                                            </div>
                                        </div>

                                        @endforeach
                                    </div>

                                </td>
                            </tr>

                            </tr>
                        </tbody>
                        @endforeach
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>


    <script>
        function toggleItems(id) {
            const itemsRow = document.getElementById(`items-${id}`);
            const arrow = document.getElementById(`fleche-${id}`);

            itemsRow.classList.toggle('hidden');
            arrow.classList.toggle('rotate-90');
        }

        document.getElementById('form-pdf').addEventListener('submit', function(e) {
            // Supprimer les inputs précédents s'ils existent
            const oldInputs = this.querySelectorAll('.temp-checkbox');
            oldInputs.forEach(input => input.remove());

            // Trouver toutes les cases cochées
            const checkedBoxes = document.querySelectorAll('.commande-checkbox:checked');

            checkedBoxes.forEach(box => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'commandes[]';
                input.value = box.value;
                input.classList.add('temp-checkbox'); // pour nettoyage
                this.appendChild(input);
            });
        });


        // Gestion de la sélection de groupe
        document.querySelectorAll('.group-checkbox').forEach(groupCheckbox => {
            groupCheckbox.addEventListener('change', function() {
                const group = this.dataset.group;
                const checkboxes = document.querySelectorAll('.commande-checkbox[data-group="' + group + '"]');
                checkboxes.forEach(cb => cb.checked = this.checked);
            });
        });
    </script>


</body>

</html>
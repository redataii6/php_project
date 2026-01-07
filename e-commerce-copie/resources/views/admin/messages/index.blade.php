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
                    <a href="{{ route('admin.commandes.index') }}">
                        <img class="logos commandes" src="{{ asset('box.png') }}" alt="">
                        <img class="logos commandes hv" src="{{ asset('box_hv.png') }}" alt="">Commandes</a>
                </li>
                <li>
                    <a href="{{ route('admin.message.index') }}" class="active">
                        <img class="logos comments hidden" src="{{ asset('commentary.png') }}" alt="">
                        <img class="logos comments hv !block" src="{{ asset('commentary_hv.png') }}" alt=""><span class="!ml-0.5">Commentaires</span></a>
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
            <div class="mt-17 mb-20">
                <h1 class=" font-extrabold text-5xl mb-5 ml-5" style="font-family: 'Apple Chancery';">Commentaires</h1>
                <p class="ml-16">Utilisez le filtre pour effectuer une recherche plus rapide.</p>
                <form method="get" action="{{ route('admin.message.index') }}" class="mt-8">
                    @csrf
                    <div class="flex space-x-4 ml-50">
                        <div class="relative h-11 w-full  max-w-[300px]">
                            <label for="note"
                                class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full text-sm font-normal  text-gray-900 ">
                                Note
                            </label>
                            <div class="sm:col-span-3">
                                <div class="relative h-11 w-full max-w-[300px]">
                                    <select id="note" name="note"
                                        class="peer h-full w-full border border-gray-400 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  focus:border-1 focus:border-black focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent ">
                                        <option value=""></option>
                                        <option value="1">1 étoile</option>
                                        <option value="2">2 étoiles</option>
                                        <option value="3">3 étoiles</option>
                                        <option value="4">4 étoiles</option>
                                        <option value="5">5 étoiles</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="relative h-11 w-full  max-w-[300px]">
                            <label for="visible"
                                class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full text-sm font-normal  text-gray-900 ">
                                Visibilité
                            </label>
                            <div class="sm:col-span-3">
                                <div class="relative h-11 w-full max-w-[300px]">
                                    <select id="visible" name="visible"
                                        class="peer h-full w-full border border-gray-400 border-t-transparent border-l-transparent border-r-transparent bg-transparent px-3 py-2.5  text-sm  text-blue-gray-700  focus:border-1 focus:border-black focus:border-t-transparent focus:border-r-transparent focus:border-l-transparent ">
                                        <option value=""></option>
                                        <option value="1">Visible</option>
                                        <option value="0">Non visible</option>
                                    </select>
                                </div>
                            </div>
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
                    <div class="flex justify-end mb-16 mt-8 mr-22">
                        <a href="{{ route('admin.message.index') }}" class="mr-5 mt-2 font-medium">Réinitialiser</a>
                        <button type="submit"
                            class=" rounded-md  px-3 py-2 text-sm font-semibold text-white shadow-sm  bg-black">Filtrer</button>
                    </div>

                </form>
                <div class="w-[80%] mx-auto grid grid-cols-2 space-y-5">
                    @foreach ( $messages as $message )
                    <div class="w-[500px] h-[280px] bg-white p-4 rounded-[20px] flex flex-col items-center relative">
                        <div class="checkbox-con absolute top-4 right-4">
                            <form action="{{ route('admin.messages.updateVisibility', $message->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input id="checkbox" type="checkbox" name="visible" onchange="this.form.submit()" {{ $message->visible ? 'checked' : '' }}>
                            </form>
                        </div>
                        <img class="rounded-full w-[50px] h-[50px] bg-black mt-6" src="{{ asset('user.png') }}" alt="">
                        <p class="font-bold">{{ $message->prenom }} {{ $message->nom }}</p>
                        <div class="flex flex-row items-center">
                            @for ($j = 0; $j < $message->note; $j++)
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.31 4.042h4.25c.969 0 1.371 1.24.588 1.81l-3.44 2.5 1.31 4.042c.3.921-.755 1.688-1.54 1.118L10 13.347l-3.43 2.492c-.785.57-1.84-.197-1.54-1.118l1.31-4.042-3.44-2.5c-.783-.57-.38-1.81.588-1.81h4.25l1.31-4.042z" />
                                </svg>
                                @endfor
                        </div>

                        <p class="text-sm text-gray-700 mb-2 mt-8 text-center">{{ $message->message }}</p>
                        <p class="text-sm text-gray-700 mt-auto">{{ $message->ville }} | {{ $message->email }} | {{ $message->phone_number }}</p>
                        <p class="text-sm text-gray-700 mt-auto">{{ $message->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>

</body>

</html>
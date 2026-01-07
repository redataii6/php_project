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
                    <a href="{{ route('admin.users.index') }}" class="active">
                        <img class="logos clients hidden" src="{{ asset('customer.png') }}" alt="">
                        <img class="logos clients hv !block" src="{{ asset('customer_hv.png') }}" alt="">Client</a>
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
            <div class="mt-17">
                <div class="flex justify-between items-center mb-5">
                    <h1 class=" font-extrabold text-5xl mb-5 ml-5" style="font-family: 'Apple Chancery';">Clients</h1>
                </div>
                <p class="ml-16">Utilisez le filtre pour effectuer une recherche plus rapide.</p>
                <form method="get" action="{{ route('admin.users.index') }}" class="mt-8">
                    @csrf
                    <div class="flex space-x-4 ml-80">
                        <div class="relative h-11 w-full max-w-[300px]">
                            <input id="nom" name="nom" value="{{ request('nom') }}"
                                class="h-full w-full border-b border-gray-400 bg-transparent pt-4 pb-1.5  text-sm font-normal text-blue-gray-700 focus:border-gray-900 focus:outline-0  " />
                            <label
                                class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full text-sm font-normal  text-gray-900 ">
                                Nom
                            </label>
                        </div>
                        <div class="relative h-11 w-full max-w-[300px]">
                            <input id="email" name="email" value="{{ request('email') }}"
                                class="h-full w-full border-b border-gray-400 bg-transparent pt-4 pb-1.5  text-sm font-normal text-blue-gray-700 focus:border-gray-900 focus:outline-0  " />
                            <label
                                class="after:content[' '] pointer-events-none absolute left-0  -top-2.5 flex h-full w-full text-sm font-normal  text-gray-900 ">
                                Email
                            </label>
                        </div>
                    </div>
                    <div class="flex justify-end mb-16 mt-8 mr-42">
                        <a href="{{ route('admin.users.index') }}" class="mr-5 mt-2 font-medium">Réinitialiser</a>
                        <button type="submit"
                            class=" rounded-md  px-3 py-2 text-sm font-semibold text-white shadow-sm  bg-black">Filtrer</button>
                    </div>

                </form>
            </div>

            <div class="relative overflow-hidden bg-white w-[70%] shadow-md rounded-lg mx-auto mb-16">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-white uppercase bg-black">
                            <tr>
                                <th scope="col" class="px-4 py-3">Nom</th>
                                <th scope="col" class="px-4 py-3">Email</th>
                                <th scope="col" class="px-4 py-3">Date d'inscription</th>
                                <th scope="col" class="px-4 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-4 py-2 font-medium text-gray-900">{{ $user->name }}</td>
                                <td class="px-4 py-2 font-medium text-gray-900">{{ $user->email }}</td>
                                <td class="px-4 py-2 font-medium text-gray-900">{{ $user->created_at->format('Y-m-d') }}</td>
                                <td class="px-4 py-2 w-[10%]">
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-6 h-6">
                                            <img src="{{ asset('effacer.png') }}" alt="">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">Aucun utilisateur trouvé.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</body>

</html>
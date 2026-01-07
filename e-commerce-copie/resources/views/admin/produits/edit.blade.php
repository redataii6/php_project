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
                <h1 class=" font-extrabold text-5xl mb-5 ml-5" style="font-family: 'Apple Chancery';">Modifier Produit</h1>
                <!-- @if ($errors->any())
                <div class="text-red-600 mb-4">
                    @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                    @endforeach
                </div>
                @endif -->

                <form action="{{ route('admin.produits.update', $produit->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex w-full gap-10">
                        <div class="ml-27">
                            <input type="file" name="images[]" id="images" multiple accept="image/*"
                                class="form-control mt-5 mb-5 text-sm text-gray-500 file:me-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-black file:text-white">

                            <div id="image-preview" class="flex gap-2 items-start">
                                <!-- Grande image -->
                                <div id="main-image" class="w-[362px] h-[503px] bg-gray-100 border rounded flex items-center justify-center text-gray-400 text-sm overflow-hidden">
                                    @if ($produit->images && $produit->images->count())
                                    <img src="{{ asset('storage/' . $produit->images[0]->image_path) }}" alt="Image principale" class="object-cover w-full h-full">
                                    @else
                                    Aucune image
                                    @endif
                                </div>

                                <!-- Miniatures dynamiques -->
                                <div id="other-images" class="flex flex-col space-y-1 items-start">
                                    @if ($produit->images && $produit->images->count() > 1)
                                    @foreach ($produit->images->skip(1) as $img)
                                    <img src="{{ asset('storage/' . $img->image_path) }}" alt="Miniature" class="w-[65px] h-[95px] object-cover border rounded cursor-pointer hover:opacity-80">
                                    @endforeach
                                    @else
                                    <div class="w-[65px] h-[95px] bg-gray-100 border rounded flex items-center justify-center text-gray-400 text-sm">+ 1</div>
                                    <div class="w-[65px] h-[95px] bg-gray-100 border rounded flex items-center justify-center text-gray-400 text-sm">+ 2</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="ml-25">
                            <div class="flex justify-between">
                                <div class="flex inputGroup">
                                    <input type="text" name="nom" id="nom" class="form-control !w-[300px]" value="{{ old('nom', $produit->nom) }}" required maxlength="255">
                                    <label for="nom" class="form-label">Nom</label>
                                </div>
                                <div class="container !w-[300px] mt-4 ml-2">
                                    <span class="prefix form-label !ml-2 !text-gray-600" for="categorie_id">Collection</span>
                                    <select class="myinput-link form-select" name="categorie_id" id="categorie_id" required>
                                        <option></option>
                                        @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}" {{ $produit->categorie_id == $categorie->id ? 'selected' : '' }}>
                                            {{ $categorie->nom }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="flex justify-between">
                                <div class="flex inputGroup">
                                    <input type="number" id="prix" class="form-control !w-[300px]" step="0.01" name="prix" value="{{ old('prix', $produit->prix) }}" required min="0">
                                    <label for="prix" class="form-label">Prix</label>
                                </div>
                                <div class="flex inputGroup">
                                    <input type="number" name="stock" id="stock" class="form-control !w-[300px]" value="{{ old('stock', $produit->stock) }}" required min="0">
                                    <label for="prix" class="form-label">Stock</label>
                                </div>
                            </div>

                            <div class="flex inputGroup">
                                <textarea name="description" id="description" class="form-control" required>{{ old('description', $produit->description) }}</textarea>
                                <label for="description" class="form-label">Description</label>
                            </div>

                            <hr class="text-gray-400">

                            <div class="flex justify-between items-center">
                                <h4 class="text-2xl font-bold mb-4 mt-5">Variantes</h4>
                                <button type="button" id="add-variant" class="w-8 h-8 text-xl text-white text-center font-semibold border bg-black rounded">+</button>
                            </div>
                            <div id="variants">
                                @foreach ($produit->variantes as $index => $variante)
                                <div class="variant-group p-4 mb-2 ">
                                    <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variante->id }}">

                                    <div class="flex justify-between">
                                        <div class="flex inputGroup">
                                            <input type="text" name="variants[{{ $index }}][color][name]" class="form-control !w-[300px]" value="{{ $variante->couleur->name ?? '' }}" required>
                                            <label class="form-label">Nom couleur</label>
                                        </div>
                                        <div class="flex inputGroup !ml-2">
                                            <input type="text" name="variants[{{ $index }}][color][hex_code]" class="form-control !w-[300px]" value="{{ $variante->couleur->hex_code ?? ''  }}" required pattern="^#([a-fA-F0-9]{3}){1,2}$">
                                            <label class="form-label">Code Hex</label>
                                        </div>
                                    </div>

                                    <div class="flex justify-between ">
                                        <div class="flex inputGroup">
                                            <input type="text" name="variants[{{ $index }}][size]" class="form-control !w-[300px]" value="{{ $variante->taille->size ?? '' }}" required>
                                            <label class="form-label">Taille</label>
                                        </div>
                                        <div class="flex inputGroup !ml-2">
                                            <input type="number" name="variants[{{ $index }}][stock]" class="form-control !w-[300px]" value="{{ $variante->stock }}" min="0" required>
                                            <label class="form-label">Stock</label>
                                        </div>
                                    </div>
                                    <button type="button" class="float-end remove-variant py-2 px-3 font-semibold text-white text-center border bg-red-800 rounded-[10px] !mb-4">Supprimer</button>
                                    <hr class="text-gray-400 !mt-15">

                                </div>
                                @endforeach
                            </div>
                            <div class="flex justify-end items-center mt-5 mb-10">
                                <a href="/admin/produits">
                                    <p class="text-red-700 font-semibold mr-4">Annuler</p>
                                </a>
                                <button type="submit" class="float-end py-2 px-3 font-semibold text-white text-center border bg-black rounded-[10px]">Modifier</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>
    <script>
        let variantIndex = {{count($produit -> variantes ?? [])}};

        document.getElementById('add-variant').addEventListener('click', () => {
            const wrapper = document.getElementById('variants');

            const div = document.createElement('div');
            div.classList.add('variant-group', 'mb-3', 'p-3');

            div.innerHTML = `

            
                <div class="flex justify-between">
                    <div class="flex inputGroup">
                        <input type="text" name="variants[${variantIndex}][color][name]" class="form-control !w-[300px]" required>
                        <label class="form-label">Nom couleur</label>
                    </div>
                    <div class="flex inputGroup !ml-2">
                        <input type="text" name="variants[${variantIndex}][color][hex_code]" class="form-control !w-[300px]" required pattern="^#([a-fA-F0-9]{3}){1,2}$">
                        <label class="form-label">Code Hex</label>
                    </div>
                </div>
                <div class="flex justify-between ">
                    <div class="flex inputGroup">
                        <input type="text" name="variants[${variantIndex}][size]" class="form-control !w-[300px]" required>
                        <label class="form-label">Taille</label>
                    </div>
                    <div class="flex inputGroup !ml-2">
                        <input type="number" name="variants[${variantIndex}][stock]" class="form-control !w-[300px]" min="0" required>
                        <label class="form-label">Stock</label>
                    </div>
                </div>
                <button type="button" class="float-end remove-variant py-2 px-3 font-semibold text-white text-center border bg-red-800 rounded-[10px] !mb-4">Supprimer</button>
                <hr class="text-gray-400 !mt-15">


        `;

            wrapper.appendChild(div);

            variantIndex++;
        });

        // Supprimer une variante
        document.getElementById('variants').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-variant')) {
                e.target.closest('.variant-group').remove();
            }
        });


        document.getElementById('images').addEventListener('change', function(event) {
            const files = event.target.files;
            const mainImageDiv = document.getElementById('main-image');
            const otherImagesDiv = document.getElementById('other-images');

            // Vider le contenu précédent
            mainImageDiv.innerHTML = '';
            otherImagesDiv.innerHTML = '';

            // Afficher l'image principale (premier fichier)
            if (files.length > 0) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('w-full', 'h-full', 'object-cover', 'rounded');
                    mainImageDiv.appendChild(img);
                };
                reader.readAsDataURL(files[0]);
            } else {
                mainImageDiv.innerText = 'Aucune image';
                mainImageDiv.classList.add('text-gray-400');
            }

            // Afficher les autres images comme miniatures
            for (let i = 1; i < files.length; i++) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.classList.add('h-[95px]', 'w-[65px]', 'border', 'rounded', 'overflow-hidden');
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('w-full', 'h-full', 'object-cover');
                    div.appendChild(img);
                    otherImagesDiv.appendChild(div);
                };
                reader.readAsDataURL(files[i]);
            }
        });
    </script>




</body>

</html>
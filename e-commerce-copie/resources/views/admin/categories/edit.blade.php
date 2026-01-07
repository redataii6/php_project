<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h2 class="text-2xl font-bold mb-4">Modifier la catégorie</h2>

    @if ($errors->any())
        <div class="text-red-500">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.categories.update', $categorie->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" value="{{ old('nom', $categorie->nom) }}" class="border rounded p-2 w-full">
        </div>

        <div>
            <label for="sexe">Sexe :</label>
            <select name="sexe" class="border rounded p-2 w-full">
                <option value="homme" {{ $categorie->sexe == 'homme' ? 'selected' : '' }}>Homme</option>
                <option value="femme" {{ $categorie->sexe == 'femme' ? 'selected' : '' }}>Femme</option>
            </select>
        </div>

        <button type="submit" class="mt-4 bg-black text-white px-4 py-2 rounded">Mettre à jour</button>
    </form>

</body>
</html>
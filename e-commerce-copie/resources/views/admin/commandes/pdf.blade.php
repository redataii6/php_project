<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Commandes sélectionnées</title>
    <style>
        body {
            font-family: sans-serif;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 33px;
            font-weight: bold;
            position: relative;
            bottom: 40px;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            color:rgb(0, 0, 0);
        }

        thead {
            background-color: black;
            color: white;
            text-transform: uppercase;
            font-size: 10px;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
        }

        .status-circle {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: orange;
            margin-right: 6px;
            vertical-align: middle;
        }

        img {
            width: 100px;
            height: 100px;
            position: relative;
            bottom: 20px;
            right: 20px;
        }

        hr{
            position: relative;
            bottom: 30px;
        }
        .p{
            position: relative;
            bottom: 30px;
        }
        #motif{
            width: 200px;
        }
    </style>
</head>

<body>
    <img src="Shiny2.png" alt="">
    <div>
        <h2>Liste de livraison</h2>
        <hr>
        <div class="p">
            <p><b>Date :</b> {{ $date }}</p>
            <p><b>Transporteur :</b></p>
        </div>
        <hr>
        <div class="container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Prix Total</th>
                        <th>Paiement</th>
                        <th>Livrée</th>
                        <th id="motif">Motif</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($commandes as $commande)
                    <tr>
                        <td># {{ $commande->id }}</td>
                        <td>{{ $commande->nom }} {{ $commande->prenom }}</td>
                        <td>{{ $commande->tel }}</td>
                        <td>{{ $commande->adresse }}</td>
                        <td>{{ $commande->total }}</td>
                        <td>
                            @if($commande->statut == 'payée')
                            {{ $commande->statut }}
                            @elseif($commande->statut == 'en attente')
                            Non payée
                            @endif
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
        }

        .container {
            width: 100%;
            padding: 10px;
            border: 1px solid #000;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 5px;
            border-bottom: 1px solid #000;
            padding-bottom: 3px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #444;
            padding: 6px;
            text-align: left;
        }

        .totals {
            margin-top: 10px;
            font-weight: bold;
        }

        #dv {
            display: flex;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Facture Commande #{{ $commande->id }}</h2>
        <p>Date : {{ \Carbon\Carbon::parse($commande->created_at)->format('d/m/Y') }}</p>

        <div style="margin-top: 10px;">
            <div class="section-title">Destinataire :</div>
            <table style="width: 100%; margin-top: 10px; font-size: 10px;">
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <strong>Nom :</strong> {{ $commande->nom }} {{ $commande->prenom }}<br>
                        <strong>Téléphone :</strong> {{ $commande->tel }}
                    </td>
                    <td style="width: 50%; vertical-align: top;">
                        <strong>Ville :</strong> {{ $commande->ville }}<br>
                        <strong>Adresse :</strong> {{ $commande->adresse }}
                    </td>
                </tr>
            </table>

        </div>

        <div style="margin-top: 10px;">
            <div class="section-title">Détails de la commande :</div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Taille</th>
                        <th>Couleur</th>
                        <th>Qté</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commande->commande_item as $item)
                    <tr>
                        <td>{{ $item->produit->nom }}</td>
                        <td>{{ $item->taille->size ?? '-' }}</td>
                        <td>{{ $item->couleur->name ?? '-' }}</td>
                        <td>{{ $item->quantite }}</td>
                        <td>{{ $item->produit->prix }} MAD</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="totals">
            Total : {{ $commande->total }} MAD <br>
            Paiement : {{ $commande->statut == 'payée' ? 'Payée' : 'À la livraison' }} <br>
            Livraison : {{ $commande->livraison }}
        </div>

        <div style="margin-top: 20px; text-align: center;">
            <div class="section-title"></div>
            <div style="display: flex; justify-content: center; margin-top: 10px;">
                <pre>Tel : 06 66 66 66 66  |  Boutique Shiny  |  www.Shiny.ma</pre>
            </div>
        </div>
    </div>
</body>

</html>
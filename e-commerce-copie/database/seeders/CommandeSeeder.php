<?php

namespace Database\Seeders;

use App\Models\Commande;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Stringable;

class CommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $villes = ['Casablanca', 'Rabat', 'Marrakech', 'Fès', 'Agadir', 'Tanger', 'Oujda', 'El Jadida', 'Kénitra', 'Tétouan',
            'Safi', 'Mohammedia', 'Beni Mellal', 'Khouribga', 'Settat', 'Salé', 'Nador', 'Taza', 'Essaouira', 'Ksar el Kebir'];
        $paiements = ['card', 'delivery'];
        $statuts = ['en attente', 'payée', 'annulée'];

        // Récupérer les utilisateurs clients existants
        $clients = User::where('role', 'client')->pluck('id')->toArray();

        if (empty($clients)) {
            $this->command->warn('Aucun utilisateur client trouvé. Exécute le UserSeeder d\'abord.');
            return;
        }

        for ($i = 1; $i < 500; $i++) {
            $userId = $clients[array_rand($clients)];
            $nom = Str::title(fake()->lastName());
            $prenom = Str::title(fake()->firstName());
            $email = fake()->unique()->safeEmail();
            $tel = '06' . rand(10000000, 99999999);
            $adresse = fake()->streetAddress();
            $ville = $villes[array_rand($villes)];
            $methode = $paiements[array_rand($paiements)];
            $statut = $statuts[array_rand($statuts)];
            $total =  rand(100, 1000) + 0.99; // Total aléatoire entre 100 et 1000 dirhams avec centimes

            Commande::create([
                'user_id' => $userId,
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'tel' => $tel,
                'adresse' => $adresse,
                'ville' => $ville,
                'methode_paiement' => $methode,
                'statut' => $statut,
                'total' => $total,
                'created_at' => '2025-06-11 00:00:00', // date fixe pour la création
            ]);
        }
    }
}

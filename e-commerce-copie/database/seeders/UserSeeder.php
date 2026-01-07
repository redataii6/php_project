<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $arabicNames = [
            
            'abdelouahed', 'abderrahim',
            'abderrazak', 'abdeslam', 'abdou', 'abdoullah', 'abdoulaye', 'abdourahman', 'abir',
            'achraf', 'adnane', 'ahmed', 'ahmede', 'ahmede', 'aicha', 'akram', 'ali', 'amal', 'amandine',
            'amine', 'anas', 'anass', 'anouar',
            'ayoub', 'ayoub', 'ayoub', 'ayoub', 'ayoub', 'ayoub', 'ayoub', 'ayoub', 'ayoub',
            'hassan', 'hatim', 'hiba', 'hind', 'houda', 'houssam', 'idris', 'ihab', 'ikram', 'ilyas',
            'imane', 'ismail', 'jamila', 'jawad', 'jid', 'karima', 'kawtar', 'khalid', 'khalil', 'khawla',
            'lahcen', 'lamia', 'lamyaa', 'latifa', 'layla', 'louay', 'loubna', 'malak', 'marouane', 'meryem',
            'mimoun', 'mohamed', 'mohcine', 'mona', 'mounia', 'mourad', 'nabil', 'nadia', 'nadir', 'naima',
            'najib', 'najlae', 'nassim', 'nawal', 'nizar', 'noor', 'nora', 'omar', 'osama', 'oumayma',
            'reda', 'rim', 'rkia', 'rnia', 'ryad', 'saad', 'salah', 'salim', 'salma', 'samira'
];

        foreach ($arabicNames as $index => $name) {
            $email = $name . $index . '@gmail.com'; // pour éviter les doublons

            User::create([
                'name' => ucfirst($name),
                'email' => $email,
                'password' => Hash::make('123456789'),
                'role' => 'client',
                'created_at' => '2025-05-11 00:00:00', // date fixe pour la création
            ]);
        }
    }
}

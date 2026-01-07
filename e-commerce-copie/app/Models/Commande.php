<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id', 'nom', 'prenom', 'email', 'tel', 'adresse', 'ville',
        'methode_paiement', 'statut', 'total'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commande_item()
    {
        return $this->hasMany(Commande_Item::class);
    }

    public function calculerTotal()
    {
        $total = $this->commande_item->sum(function ($item) {
            return $item->quantite * $item->prix_unitaire;
        });

        $this->update(['total' => $total]);
    }
}

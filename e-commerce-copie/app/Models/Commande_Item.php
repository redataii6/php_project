<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande_Item extends Model
{
    //
    use HasFactory;

    protected $fillable = ['commande_id', 'produit_id', 'quantite', 'prix_unitaire',
        'product_color_id', 'product_size_id'];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

    public function taille()
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id');
    }

    public function couleur()
    {
        return $this->belongsTo(ProductColor::class, 'product_color_id');
    }

    

    protected static function booted()
    {
        static::saved(function ($item) {
            $item->commande->calculerTotal();
        });

        static::deleted(function ($item) {
            $item->commande->calculerTotal();
        });
    }
}

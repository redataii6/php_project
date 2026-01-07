<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    //
    protected $fillable = [
        'nom',
        'description',
        'prix',
        'stock',
        'categorie_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    public function colors()
    {
        return $this->belongsToMany(ProductColor::class, 'produit_variantes', 'produit_id', 'color_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(ProductSize::class, 'produit_variantes', 'produit_id', 'size_id');
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function panier()
    {
        return $this->hasMany(Panier::class);
    }

    public function variantes()
    {
        return $this->hasMany(ProduitVariante::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'produit_id');
    }

    public function firstPhoto()
    {
        return $this->hasOne(ProductImage::class)->oldest(); // Ou orderBy('id') si tu veux la première photo ajoutée
    }

    public function commande__items()
    {
        return $this->hasMany(Commande_Item::class, 'produit_id');
    }
}

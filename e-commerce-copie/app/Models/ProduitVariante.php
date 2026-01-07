<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduitVariante extends Model
{
    //
    protected $fillable = ['produit_id', 'size_id', 'color_id', 'stock'];


    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

    public function couleur()
    {
        return $this->belongsTo(ProductColor::class, 'color_id');
    }

    public function taille()
    {
        return $this->belongsTo(ProductSize::class, 'size_id');
    }
}

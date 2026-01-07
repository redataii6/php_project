<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    //
    protected $fillable = [
        'size'
    ];


    public function variantes()
    {
        return $this->hasMany(ProduitVariante::class, 'size_id');
    }
    public function paniers()
    {
        return $this->hasMany(Panier::class, 'product_size_id');
    }
}

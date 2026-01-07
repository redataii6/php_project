<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    //
    protected $fillable = [
        'name',
        'hex_code'
    ];


    public function variantes()
    {
        return $this->hasMany(ProduitVariante::class, 'color_id');
    }
    public function paniers()
    {
        return $this->hasMany(Panier::class, 'product_color_id');
    }
}

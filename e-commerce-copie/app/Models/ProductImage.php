<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    //
    protected $fillable = ['produit_id','image_path'];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}

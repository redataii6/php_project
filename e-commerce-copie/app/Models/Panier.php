<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    //
    use HasFactory;

    protected $fillable = ['user_id', 'produit_id', 'quantite', 'reserved_until',
        'product_color_id', 'product_size_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class, 'product_color_id');
    }
    public function productSize()
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id');
    }
    

}

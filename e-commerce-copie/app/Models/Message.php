<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'nom', 'prenom', 'email', 'phone_number', 'message', 'accept_politique', 'note', 'ville', 'visible'
    ];

}

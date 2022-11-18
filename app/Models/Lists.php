<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    use HasFactory;

    //Champs nécessaires d'un élément de la table Lists
    protected $fillable = [
        "product_id", "user_id"
    ];
}

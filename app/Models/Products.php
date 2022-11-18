<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    //Champs nécessaires d'un élément de la table Products
    protected $fillable = [
        "name_product", "price", "status"
    ];
}

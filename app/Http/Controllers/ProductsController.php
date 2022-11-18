<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Concerns\ValidatesAttributes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Lists;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Affichage de tous les produits
        $products = Products::all();
        //Si il n'y a aucun produit alors on affiche "Aucun produit disponible"
        if(count($products) <= 0) { 
            return response(["message" => "Aucun produit disponible"], 200);
        }
        return response($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Fonction d'ajout d'un produit

        //Vérification des éléments du produit
        $productsValidation = $request->validate([ 
            "name_product" => ["required", "string"],
            "price" => ["required", "numeric"],
            "status" => ["required", "boolean"],
        ]);

        //Création du produit
        $products = Products::create([ 
            "name_product" => $productsValidation["name_product"],
            "price" => $productsValidation["price"],
            "status" => $productsValidation["status"],
        ]);

        return response(["message" => "produit ajouté"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $id)
    {
        //Fonction ajout du produit dans la liste

        //Récupération de l'id de l'utilisateur connecté
        $UserAuth_id = Auth::user()->id;

        //Vérification du changement d'état du produit (de 0 "pour non acheté" à 1 "pour acheté")
        $productValidation = $request->validate([
            "name_product" => ["required", "string"],
            "price" => ["required", "numeric"],
            "status" => ["required", "boolean", "in:1"],
            //"status" à 1 requis 
        ]);

        //La variable $product reprend les éléments du produit
        $product = ([ 
            "name_product" => $productValidation["name_product"],
            "price" => $productValidation["price"],
            "status" => 0,
            //Cette variable a son "status" à 0 pour pouvoir retrouver le produit dans la table Produits
        ]);
        //Récupération de l'id du produit qui correspond aux éléments du produit put
        $product_id = Products::where("name_product", "=", $product["name_product"])
        ->where("price", "=", $product["price"])
        ->where("status", "=", $product["status"])
        ->first()
        ->id;

        //Création du produit dans la table Lists avec le product_id récupéré et le user_id
        Lists::create([ 
            "product_id" => $product_id, //Produit avec comme product_id l'id du produit récupéré correspondant au produit dont l'état à changé
            "user_id" => $UserAuth_id, //Produit avec comme user_id l'id de l'utilisateur connecté
        ]);

        return response(["message" => "produit ajouté dans la liste"], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        //
    }
}

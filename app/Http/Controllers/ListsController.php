<?php

namespace App\Http\Controllers;

use App\Models\Lists;
use App\Models\User;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function index()
    {
        //Affichage de la liste de l'utilisateur

        //On récupère l'id de l'utilisateur connecté
        $UserList_id = Auth::user()->id; 

        //Sélection de la colonne "product_id" de la table "lists"
        $Lists = DB::table("lists")
        ->select("lists.product_id") 
        ->where("user_id", "=", $UserList_id)
        //Où le "user_id" correspond au $UserList_id (id de l'utilisateur)
        ->get();

        //Affichage des produits

        if(count($Lists) <= 0) {
            return response(["message" => "Aucun produit disponible dans la liste de cet utilisateur"], 200);
        }
        return response($Lists, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function show(Lists $lists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lists $lists)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Lists $id)
    {
        //Fonction suppression d'un produit de la liste

        //Récupération de l'id de l'utilisateur connecté
        $UserAuth_id = Auth::user()->id; 

        //Vérification du produit existant dans la table Lists
        $productsValidation = $request->validate([ 
            "product_id" => ["required", "numeric"],
            "user_id" =>  ["required", "in:$UserAuth_id"],
            //Vérification de l'id utilisateur qui correspond bien à l'id de l'utilisateur connecté
        ]);
        
        //Récupération du product_id de la table lists
        $product_id = $productsValidation["product_id"]; 

        //Récupération de l'id du produit en question dans la table Lists grâce à l'id de l'utilisateur connecté et du product_id
        $product = Lists::where("product_id", "=", $product_id)
        ->where("user_id", "=", $UserAuth_id)
        ->first()
        ->id;

        //Suppression du produit grâce à son id
        $value = Lists::destroy($product); 
        return response(["message" => "Le produit de la liste a bien été supprimé"]);
    }
}

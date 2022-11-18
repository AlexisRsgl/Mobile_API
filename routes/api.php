<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ListsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



//Route pour créer des produits (optionnelle)
Route::post("/products", [ProductsController::class, "store"]);

//Route pour inscrire un utilisateur
Route::post('/inscription', [UserController::class, "inscription"]); //Fonction inscription dans UserController avec la méthode post

//Route pour la connexion de l'utilisateur
Route::post('/connexion', [UserController::class, "connexion"]); //Fonction connexion dans UserController avec la méthode post


//Groupe de routes protégées (propre à l'utilisateur)
Route::group(["middleware" => ["auth:sanctum"]], function() {

    //Route pour déconnecter l'utilisateur
    Route::post("/deconnexion", [UserController::class, "deconnexion"]); //Fonction déconnexion dans UserController avec la méthode post

    //Route pour avoir tous les produits disponibles
    Route::get("/products", [ProductsController::class, "index"]); //Fonction index dans ProductsController avec la méthode get

    //Route pour afficher les produits de la liste de l'utilisateur
    Route::get("/list", [ListsController::class, "index"]); //Fonction index dans ListsController avec la méthode get

    //Route pour passé le produit de "non acheté" à "acheté"
    Route::put("/products", [ProductsController::class, "update"]); //Fonction update dans ProductsController avec la méthode put

    //Route pour passé le produit de "acheté" à "non acheté"
    Route::delete("/list", [ListsController::class, "destroy"]); //Fonction destroy dans ListsController avec la méthode delete

});

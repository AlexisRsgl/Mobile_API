<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //Fonction inscription d'un utilisateur

    public function inscription(Request $request) {
        //Vérification des éléments requis pour l'inscription
        $utilisateurDonnee = $request->validate([ 
            "firstname" => ["required", "string", "min:3", "max:50"],
            "name" => ["required", "string", "min:3", "max:50"],
            "email" => ["required", "email", "unique:users,email"],
            //L'adresse email doit être unique
            "password" => ["required", "string", "min:8", "max:50", "regex:/[A-Z]/", "regex:/[0-9]/", "regex:/[@$!%*#?&]/", "confirmed"] 
            //Le mot de passe doit contenir au moins 8 caractères, 1 majuscule, 1 chiffre et 1 caractère spécial
        ]);

        //Création de l'utilisateur avec les données envoyées
        $utilisateurs = User::create([ 
            "firstname" => $utilisateurDonnee["firstname"],
            "name" => $utilisateurDonnee["name"],
            "email" => $utilisateurDonnee["email"],
            "password" => bcrypt($utilisateurDonnee["password"])
        ]);

        return response($utilisateurs, 201);
    }

    //Fonction connexion d'un utilisateur

    public function connexion(Request $request) {
        //Vérification pour validation de connexion
        $utilisateurDonnee = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required", "string", "min:8", "max:50", "regex:/[A-Z]/", "regex:/[0-9]/", "regex:/[@$!%*#?&]/"] /* "regex:/[A-Z]/", "regex:/[0-9]/", "regex:/[@$!%*#?&]/" */
        ]);

        $utilisateur = User::where("email", $utilisateurDonnee["email"])->first();
        //Si l'email envoyé ne correspond pas à l'email dans la BDD alors erreur 401
        if(!$utilisateur) return response(["message" => "Cet email $utilisateurDonnee[email] ne correspond à aucun utilisateur"], 401);
        //Si le mot de passe envoyé ne correspond pas à l'utilisateur dans la BDD alors erreur 401
        if(!Hash::check($utilisateurDonnee["password"], $utilisateur->password)) return response(["message" => "Aucun utilisateur trouvé avec ce mot de passe"], 401);
        //Création du token de l'utilisateur pour pouvoir le reprendre et tester les fonctionnalités suivantes
        $token = $utilisateur->createToken("CLE_SECRETE")->plainTextToken;

        return response( [
            "utilisateur" => $utilisateur,
            "token" => $token
        ], 200);
    }

    //Fonction de déconnexion

    public function deconnexion() {
        //Récupération du token de l'utilisateur connecté
        auth()->user()->tokens->each(function($token, $key) { 
            $token->delete(); 
            //Destruction du token
        });
        return response(["message" => "Vous êtes déconnecté"], 200);
    }

}
<?php

namespace tweeterapp\auth;

class TweeterAuthentification extends \mf\auth\Authentification {

    /*
     * Classe TweeterAuthentification qui définie les méthodes qui dépendent
     * de l'application (liée à la manipulation du modèle User) 
     *
     */

    /* niveaux d'accès de TweeterApp 
     *
     * Le niveau USER correspond a un utilisateur inscrit avec un compte
     * Le niveau ADMIN est un plus haut niveau (non utilisé ici)
     * 
     * Ne pas oublier le niveau NONE un utilisateur non inscrit est hérité 
     * depuis AbstractAuthentification 
     */
    const ACCESS_LEVEL_USER  = 100;   
    const ACCESS_LEVEL_ADMIN = 200;

    /* constructeur */
    public function __construct(){
        parent::__construct();
    }

    /* La méthode createUser 
     * 
     *  Permet la création d'un nouvel utilisateur de l'application
     * 
     *  
     * @param : $username : le nom d'utilisateur choisi 
     * @param : $pass : le mot de passe choisi 
     * @param : $fullname : le nom complet 
     * @param : $level : le niveaux d'accès (par défaut ACCESS_LEVEL_USER)
     * 
     * Algorithme :
     *
     *  Si un utilisateur avec le même nom d'utilisateur existe déjà en BD
     *     - soulever une exception 
     *  Sinon      
     *     - créer un nouvel modèle User avec les valeurs en paramètre 
     *       ATTENTION : Le mot de passe ne doit pas être enregistré en clair.
     * 
     */
    
    public function createUser($username, $pass, $fullname,
                               $level=self::ACCESS_LEVEL_USER) { 

                                $userbdd = \tweeterapp\model\User::select()->where('username','=',$username)->first();
                                    if (isset($userbdd->username)) {
                                        throw new \Exception("Veuillez changer de nom utilisateur", 1);
                                        
                                    }else{

                                        $newuser = new \tweeterapp\model\User();
                                        $newuser->fullname = $fullname;
                                        $newuser->username = $username;
                                        $newuser->password = $this->hashPassword($pass);
                                        $newuser->level = $level;
                                        $newuser->followers = 0;
                                        $newuser->save();


                                    }



                                }

    /* La méthode login
     *  
     * permet de connecter un utilisateur qui a fourni son nom d'utilisateur 
     * et son mot de passe (depuis un formulaire de connexion)
     *
     * @param : $username : le nom d'utilisateur   
     * @param : $password : le mot de passe tapé sur le formulaire
     *
     * Algorithme :
     * 
     *  Récupérer l'utilisateur avec le nom d'utilisateur $username depuis la BD
     *  Si aucun de trouvé 
     *      soulever une exception 
     *  sinon 
     *      si $password correspond au mot de passe crypté en BD 
     *          charger la session de l'utilisateur
     *      sinon soulever une exception
     *
     */
    
    public function login($username, $password){ 

    $userbdd = \tweeterapp\model\User::select()->where('username','=',$username)->first();

    if (!isset($userbdd->username)) {
        
        throw new \Exception("Identifiants invalides");
    }else{

        if ($this->verifyPassword($password,$userbdd->password)) {

            $this->updateSession($username,$userbdd->level);

            
        }else{

            throw new \Exception("Identifiants invalides");
            

        }

    }





    }

}

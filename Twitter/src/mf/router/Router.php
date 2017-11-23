<?php
namespace mf\router;

/**
* 
*/
class Router extends AbstractRouter
{
	/* 
     * Méthode addRoute : ajoute une route a la liste des routes 
     *
     * Paramètres :
     * 
     * - $name (String) : un nom pour la route
     * - $url (String)  : l'url de la route
     * - $ctrl (String) : le nom de la classe du Contrôleur 
     * - $mth (String)  : le nom de la méthode qui réalise la fonctionalité 
     *                     de la route
     * 
     * Algorithme :
     *
     * - Ajouter le tablau [ $ctrl, $mth ] au tableau $this->route 
     *   sous la clé $url et sous la clé $name 
     *
     */
	
	public function addRoute($name, $url, $ctrl, $mth){

		self::$routes[$url]=[$ctrl,$mth];
		self::$routes[$name]=[$ctrl,$mth];



     }

     /*
     * Méthode run : execute une route en fonction de la requête 
     *
     *
     * Algorithme :
     * 
     * - l'URL de la route est stockée dans l'attribut $path_info de 
     *         $http_request
     *   Et si une route existe dans le tableau $route sous le nom $path_info
     *     - créer une instance du controleur de la route
     *     - exécuter la méthode de la route 
     * - Sinon 
     *     - exécuter la route par défaut : 
     *        - créer une instance du controleur de la route par défault
     *        - exécuter la méthode de la route par défault
     * 
     */

     public function run(){
          
     $r = $this->http_req->path_info; // variable qui recup path_info

     //verif si la route existe 
     if (isset (self::$routes[$r])){

       $ctrl_name = self::$routes[$r][0]; // recup ctrl
       $mth_name = self::$routes[$r][1];//recup mth 

       $ctrl = new $ctrl_name(); //instance du controleur
       $ctrl->$mth_name(); // execution de la methode 


  }else{

   $ctrl_name = self::$routes['default'][0]; 
   $mth_name = self::$routes['default'][1];

   $ctrl = new $ctrl_name();
   $ctrl->$mth_name();

}


}
}
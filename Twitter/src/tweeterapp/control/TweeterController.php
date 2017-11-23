<?php

namespace tweeterapp\control;



/* Classe TweeterController :
 *  
 * Réalise les algorithmes des fonctionnalités suivantes: 
 *
 *  - afficher la liste des Tweets 
 *  - afficher un Tweet
 *  - afficher les tweet d'un utilisateur 
 *  - afficher la le formulaire pour poster un Tweet
 *  - afficher la liste des utilisateurs suivis 
 *  - évaluer un Tweet
 *  - suivre un utilisateur
 *   
 */

class TweeterController extends \mf\control\AbstractController {


	/* Constructeur :
	 * 
	 * Appelle le constructeur parent
	 *
	 * c.f. la classe \mf\control\AbstractController
	 * 
	 */
	
	public function __construct(){
		parent::__construct();
	}


	/* Méthode viewHome : 
	 * 
	 * Réalise la fonctionnalité : afficher la liste de Tweet
	 * 
	 */
	
	public function viewHome(){

		/* Algorithme :
		 *  
		 *  1 Récupérer tout les enregistrements en utilisant le modèle Tweet
		 *  2 Parcourir le résultat 
		 *      afficher le text, l'auteur et la date de création
		 * 
		 */


		/*foreach ($lignes1 as $v) {
			echo "$v->id Tweet : $v->text , $v->author , $v->created_at" ;
			echo "</br>";
		}
		echo "<br>";*/
       

		$requete1 = \tweeterapp\model\Tweet::select()->orderBy('updated_at');
		$lignes1 = $requete1 ->get();

		

	   $tweets = \tweeterapp\model\Tweet::all();
       $vue = new \tweeterapp\view\TweeterView($tweets);
	   $vue->render('home');


  
      
	}


	/* Méthode viewTweet : 
	 *  
	 * Réalise la fonctionnalité afficher un Tweet
	 *
	 */
	
	public function viewTweet(){

		/* Algorithme : 
		 *  
		 *  1 L'identifiant du Tweet en question est passé en paramètre (id) 
		 *      d'une requête GET 
		 *  2 Récupérer le Tweet depuis le modèle Tweet
		 *  3 Afficher toutes les informations du tweet 
		 *      (text, auteur, date, score)
		 * 
		 *  Erreurs possibles : (*** à implanter ultérieurement ***)
		 *    - pas de paramètre dans la requête
		 *    - le paramètre passé ne correspond pas a un identifiant existant
		 *    - le paramètre passé n'est pas un entier 
		 * 
		 */

		$tweet = \tweeterapp\model\Tweet::select()->where('id','=',$this->request->get['id'])->first();
		

	   $vue = new \tweeterapp\view\TweeterView($tweet);
		$vue->render('view');

		
	}


	/* Méthode viewUserTweets :
	 *
	 * Réalise la fonctionnalité afficher les tweet d'un utilisateur
	 *
	 */
	
	public function viewUserTweets(){

		/*
		 *
		 *  1 L'identifiant de l'utilisateur en question est passé en 
		 *      paramètre (id) d'une requête GET 
		 *  2 Récupérer l'utilisateur et ses Tweets depuis le modèle 
		 *      Tweet et User
		 *  3 Afficher les informations de l'utilisateur 
		 *      (non, login, nombre de suiveurs) 
		 *  4 Afficher ses Tweets (text, auteur, date)
		 * 
		 *  Erreurs possibles : (*** à implanter ultérieurement ***)
		 *    - pas de paramètre dans la requête
		 *    - le paramètre passé ne correspond pas a un identifiant existant
		 *    - le paramètre passé n'est pas un entier 
		 */

	$user = \tweeterapp\model\User::where('id', '=', $this->request->get['id'])->first();
	//$liste_tweet = $user->tweets()->get();

	 $vue = new \tweeterapp\view\TweeterView($user);


		$vue->render('user');
	}

	public function viewNewTweet(){

	$vue = new \tweeterapp\view\TweeterView('');
	$vue->render('newtweet');

    }

    public function viewSendTweet(){

    	if(isset($this->request->post['newTweet'])){

		$form=$this->request->post;

			}
		
		if (isset($form)) {

		$tweet = new \tweeterapp\model\Tweet();
		$tweet->text=$form['newTweet'];
		$tweet->author="1";
		$tweet->save();
			
		}

	$vue = new \tweeterapp\view\TweeterView('');
	$vue->render('newtweet');




    }


public function viewLogin(){


	$vue = new \tweeterapp\view\TweeterView('');
	$vue->render('login');


}

public function viewVerifyLogin(){

	if(isset($this->request->post['username'])){
			$form=$this->request->post;
		}

	if (isset($form)) {
		
		$authentification = new \tweeterapp\auth\TweeterAuthentification();
		$authentification->login($form['username'],$form['password']);
		return $this->viewHome();

	}else{

		$vue = new \tweeterapp\view\TweeterView('');
		return $vue->render('viewLogin');


	}



}

public function viewSignup(){


	$vue = new \tweeterapp\view\TweeterView('');
	$vue->render('signup');


}


public function viewCheckSignup(){

	$vue = new \tweeterapp\view\TweeterView('');
	
if(isset($this->request->post['username'])){
			$form=$this->request->post;
		}

	if (isset($form)) {

		$authentification = new \tweeterapp\auth\TweeterAuthentification();
		$authentification->createUser($form['username'],$form['password'], $form['fullname']);
		return $vue->render('checksignup');


	}else{

		return $vue->render('signup');

	}



}

public function viewLogout(){

	$authentification = new \tweeterapp\auth\TweeterAuthentification();
	$authentification->logout();
	return $this->viewHome();
}



	
}
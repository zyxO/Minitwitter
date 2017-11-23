<?php

namespace mf\auth;

/**
* 
*/
class Authentification extends AbstractAuthentification
{
	
	function __construct()
	{
		# code...

		if(isset($_SESSION['user_login'])){

			$this->user_login = $_SESSION['user_login'];
			$this->access_level = $_SESSION['access_level'];
			$this->logged_in = TRUE;


		}else{

				$this->user_login =null;
			$this->access_level = self::ACCESS_LEVEL_NONE;

			$this->logged_in = FALSE;


		}


	}



function updateSession($username, $level){

	$this->user_login = $username;
	$this->access_level = $level;
	$_SESSION['user_login']= $username;
	$_SESSION['access_level']=$level;
	$this->logged_in = TRUE;


	}

public function logout(){

		$_SESSION['user_login']=null;
		$_SESSION['access_level']= self::ACCESS_LEVEL_NONE;
		$this->logged_in = FALSE;




	}


	public function checkAccessRight($requested){

		if ($requested>$this->access_level) {
			# code...
			return FALSE;
		}else{

			return TRUE;
		}


	}

	protected function hashPassword($password){

		return password_hash($password,PASSWORD_DEFAULT);



	}


	protected function verifyPassword($password, $hash){

		return password_verify($password,$hash);


	}


}
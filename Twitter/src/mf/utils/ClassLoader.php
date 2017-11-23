<?php 

/**
* 
*/
namespace mf\utils;

class ClassLoader 
{

	private $prefix;

	function __construct($valeur)
	{
# code...

		$this->prefix = $valeur;

	}



	public function loadClass($string){

		$string = strtr($string, "\\", DIRECTORY_SEPARATOR);
		$string =$this->prefix.DIRECTORY_SEPARATOR.$string.".php";
		if (file_exists($string)) {
			require_once($string);
		}
		

	}

	public function register(){

		spl_autoload_register([$this,"loadClass"]);
	}

	


}








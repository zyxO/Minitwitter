<?php

namespace mf\control;

abstract class AbstractController {
  
  /* Attribut pour stocker l'objet HttpRequest */ 
  protected $request=null; 
  
  /*
   * Constructeur :
   * 
   * Reçoit une instance de la classe HttRequest et la stocke dans l'attribut
   *    $request 
   *
   */
  
  public function __construct(){
      $this->request = new \mf\utils\HttpRequest() ;
  }
  
}


  
<?php

/**
* 
*/
namespace tweeterapp\model; 


class User extends \Illuminate\Database\Eloquent\Model {

       protected $table      = 'user';  /* le nom de la table */
       protected $primaryKey = 'id';     /* le nom de la clé primaire */
       public    $timestamps = false;    /* si vrai la table doit contenir
                                            les deux colonnes updated_at,
                                            created_at */



public function tweets() {
       return $this->hasMany('tweeterapp\model\Tweet', 'author');


       /* 'Tweet'    : le nom de la classe du model lié */
       /* 'author' : la clé étrangère dans la table courante */

}


}
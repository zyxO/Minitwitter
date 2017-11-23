<?php

/**
* 
*/
namespace tweeterapp\model;


class Tweet extends \Illuminate\Database\Eloquent\Model {

	protected $table      = 'tweet';  /* le nom de la table */
	protected $primaryKey = 'id';     /* le nom de la clé primaire */
       public    $timestamps = true;    /* si vrai la table doit contenir
                                            les deux colonnes updated_at,
                                            created_at */

public function author() {
       return $this->belongsTo('tweeterapp\model\User', 'author');

       /* 'User'    : le nom de la classe du model lié */
       /* 'author' : la clé étrangère dans la table courante */
}


                                        }
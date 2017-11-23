<?php

namespace tweeterapp\view;

class TweeterView extends \mf\view\AbstractView {

    /* Constructeur 
    *
    * Appelle le constructeur de la classe \mf\view\AbstractView
    */
    public function __construct( $data ){
        parent::__construct($data);
    }

    /* Méthode renderHeader
     *
     *  Retourne le fragment HTML de l'entête (unique pour toutes les vues)
     */ 
    public function renderHeader(){

        $chaine = '';

        $chaine .=  '<header class = "theme-backcolor1"><h1>MiniTweeTR</h1>';
        $chaine .= '<nav id = "navbar">
        <a class = "tweet-control" href = "'.$this->script_name.'/home/">

        <img alt = "home" src = "'.$this->app_root.'/html/home.png"></a>';


        if (isset($_SESSION['user_login'])) {

           $chaine .= '<a class = "tweet-control" href = "'.$this->script_name.'/logout/">

        <img alt = "login" src = "'.$this->app_root.'/html/logout.png">
        </a>';

        }else{

         $chaine.=  '<a class = "tweet-control" href = "'.$this->script_name.'/login/">

        <img alt = "login" src = "'.$this->app_root.'/html/login.png">
        </a>

        <a class = "tweet-control" href = "'.$this->script_name.'/signup/">

        <img alt = "signup" src = "'.$this->app_root.'/html/signup.png">
        </a>';  
        }
       

        '</nav>';
        $chaine .= '</header>';

        return $chaine;
    }
    
    /* Méthode renderFooter
     *
     * Retourne  le fragment HTML du bas de la page (unique pour toutes les vues)
     */
    public function renderFooter(){
        return '<footer class="theme-backcolor1">La super app créée en Licence Pro &copy;2017</footer>';
    }

    /* Méthode renderHome
     *
     * Retourne le fragment HTML qui réalise la fonctionalité afficher
     * tout les Tweets. 
     *  
     * L'attribut $this->data contient un tableau d'objets tweet.
     * 
     */
    
    public function renderHome(){
        $chaine = "";

        $chaine .= '<section>

        <article class="theme-backcolor2"> <h2>Latest Tweets</h2>';
        foreach ($this->data as $v) {
            $auteur = $v->author()->first()->username; 
            $recupidtweet= $v->id;
            $recupiduser= $v->author()->first()->id; 
            $lien = $this->script_name.'/view/?id='.$recupidtweet;
            $user = $this->script_name.'/user/?id='.$recupiduser;
            $texttwitter = $v->text;
            $creation = $v->created_at;
            $update  = $v->updated_at;
            $chaine.='


            <div class = "tweet">

            <a class ="tweet-text" href = '.$lien.'>'.$texttwitter.'</a>

            <div class = "tweet-footer">

            <span class = "tweet-timestamp">'.$creation.'</span>

            <span class = "tweet-author"><a href='.$user.'>'.$auteur.'</a>
            </span>

            </div>

            </div>  



            ';


              /*  $chaine .= "<a class = 'tweet' href=$lien>Tweet : $v->text $v->created_at</a>
              <a class = 'tweet' href = $user> </br>$auteur</a></br></br>";*/    
          }
         //echo $this->script_name;

          $chaine .= ' 
          </article>
          <nav id="menu" class="theme-backcolor1">  </nav>

          </section>';

          return $chaine;

      }

    /* Méthode renderUeserTweets
     *
     * Retourne le fragment HTML qui réalise la fonctionalité afficher
     * tout les Tweets d'un utilisateur donné. 
     *  
     * L'attribut $this->data contient un objet User.
     * 
     */

    public function renderUserTweets(){ 
     $chaine = "";

        //$v = $this->data; // data n'est pas un tableau car on fait first
        //$chaine .= "$v->text $v->username $v->created_at $v->score </br>";
    $fullname=$this->data->fullname;
    $username=$this->data->username;
    $follower = $this->data->followers;

    
   
     $Tweet = $this->data->tweets()->get();

       $chaine .= '<section>

        <article class="theme-backcolor2"> <h2>'.$fullname.'</h2>
        <h3>'.$username.'</h3>
        <h3>'.$follower.' followers</h3>';
     foreach ($Tweet as $key => $v) {
            # code...
    $recupidtweet= $v->id;
    $recupiduser= $v->author()->first()->id; 
    $lien = $this->script_name.'/view/?id='.$recupidtweet;
    $user = $this->script_name.'/user/?id='.$recupiduser;
    $texttwitter = $v->text;
    $creation = $v->created_at;
    $update  = $v->updated_at;

 $chaine.='


            <div class = "tweet">

            <a class ="tweet-text" href = '.$lien.'>'.$texttwitter.'</a>

            <div class = "tweet-footer">

            <span class = "tweet-timestamp">'.$creation.'</span>

            <span class = "tweet-author"><a href='.$user.'>'.$username.'</a>
            </span>

            </div>

            </div>  



            ';

        /*$chaine .= "<div>$value->fullname</br></br>$value->text</div>";*/
    }
    
    $chaine .= ' 
          </article>
          <nav id="menu" class="theme-backcolor1">  </nav>

          </section>';


    return $chaine;


}

    /* Méthode renderViewTweet 
     * 
     * Retourne le fragment HTML qui réalise l'affichage d'un tweet particulié 
     * 
     * L'attribut $this->data contient un objet Tweet
     *
     */

    public function renderViewTweet(){ 

        $chaine = "";
        $v = $this->data; // data n'est pas un tableau car on fait first
        $a = $v->author()->first()->username; 
        $recupidtweet= $v->id;
        $recupiduser= $v->author()->first()->id; 
        $lien = $this->script_name.'/view/?id='.$recupidtweet;
        $user = $this->script_name.'/user/?id='.$recupiduser;
        $texttwitter = $v->text;
        $creation = $v->created_at;
        $score = $v->score;



        $chaine .= '<section>

        <article class="theme-backcolor2">

        <div class = "tweet">

        <a class ="tweet-text" href = '.$lien.'>'.$texttwitter.'</a>

        <div class = "tweet-footer">

        <span class = "tweet-timestamp">'.$creation.'</span>

        <span class = "tweet-author"><a href='.$user.'>'.$a.'</a>
        </span>

        </div>
        <div class="tweet-footer"><hr><span class="tweet-score tweet-control">'.$score.'</span> </div
        </div>  

        </article>

        </section>


        ';
        /*   $chaine .= "$v->id Tweet : $v->text , $a , $v->created_at , $v->score </br> ";*/

        return $chaine;



    }




    private function renderViewNewTweet(){
       
$linkform = $this->script_name."/send/";

        $chaine="\n".'<form id="formInsertTweet" action="'.$linkform.'" method="POST">'."\n";
        $chaine.="<label for='newTweet'>Écrire un nouveau Tweet</label>\n";
        $chaine.="<textarea id='newTweet' name='newTweet' rows='6' cols='40' maxlength='140'></textarea>\n";
        $chaine.="<input type='submit' value='Send'/>\n";
        $chaine.="</form>\n";   
        return $chaine;
    } 





private function renderViewLogin(){

$checklogin= $this->script_name."/checklogin/";

$chaine = "";

$chaine.='<section>

   <article class="theme-backcolor2">  <form class="forms" action="'.$checklogin.'" method="post">
<input class="forms-text"  id="username" name="username" placeholder="username" type="text">
<input class="forms-text" id="password" name="password" placeholder="password" type="password">
<button class="forms-button" name="login_button" type="submit">Login</button>
</form> </article>   

   <nav id="menu" class="theme-backcolor1">  </nav>

</section>' ;

return $chaine;
 } 




 private function renderViewSignup(){
$checksignup= $this->script_name."/check_signup/";
$chaine = "";
$chaine .='<section>

   <article class="theme-backcolor2">  <form class="forms" action="'.$checksignup.'" method="post">
<input class="forms-text" id ="fullname" name="fullname" placeholder="full Name" type="text">
<input class="forms-text" id="username" name="username" placeholder="username" type="text">
<input class="forms-text" id="password" name="password" placeholder="password" type="password">
<input class="forms-text" id="password_verify" name="password_verify" placeholder="retype password" type="password">

<button class="forms-button" name="login_button" type="submit">Create</button>
</form> </article>   

   <nav id="menu" class="theme-backcolor1">  </nav>

</section>';


return $chaine;


 }

 private function renderCheckViewSignUp(){

$chaine = "";

$chaine.='
    <section>

   <article class="theme-backcolor2"> 
    <div> utilisateur créé </div>
     </article>   

   <nav id="menu" class="theme-backcolor1">  </nav>

</section>

' ;

return $chaine;



}


    /* Méthode renderBody
     *
     * Retourne la framgment HTML de la balise <body> elle est appelée
     * par la méthode héritée render.
     *
     * En fonction du selecteur (un string) passé en paramètre, elle remplit les
     * blocs avec le résultats des différentes méthodes définit plus
     * haut
     * 
     */
    
    public  function renderBody($selector=null){
        $head = $this->renderHeader();
        $footer = $this->renderFooter();

        switch ($selector) {
            case 'home':
            $main = $this->renderHome();
            break;

            case 'user':
            $main = $this->renderUserTweets();
            break;

            case 'view':
            $main = $this->renderViewTweet();
            break;

            case 'newtweet':
            $main = $this->renderViewNewTweet();
            break;

            case 'login':
            $main = $this->renderViewLogin();
            break;

            case 'checkviewLogin':
            $main = $this->renderCheckViewLogin();
            break;

            case 'signup':
            $main = $this->renderViewSignup();
            break;

            case 'checksignup':
            $main = $this->renderCheckViewSignUp();

            default:
            $main = $this->renderHome();
            break;

        }


        $html = <<<EOT

        <header>
        ${head}
        </header>
        <section>
        ${main}
        </section>
        <footer>
        ${footer}
        </footer>

EOT;

        return  $html;
        
    }

}

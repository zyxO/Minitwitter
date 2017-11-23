<?php

/*variable de sessions*/
session_start();


/* pour le chargement automatique des classes dans vendor */

require_once 'src/mf/utils/ClassLoader.php';
require_once 'vendor/autoload.php';



$loader = new \mf\utils\ClassLoader('src');
$loader->register();

use \tweeterapp\model\Follow as Follow;
use \tweeterapp\model\Like as Like;
use \tweeterapp\model\Tweet as Tweet;
use \tweeterapp\model\User as User;
use \mf\router\Router as Router;
use \tweeterapp\view\TweeterView as TweeterView;

$config = [
       'driver'    => 'mysql',
       'host'      => 'localhost',
       'database'  => 'twitter',
       'username'  => 'root',
       'password'  => 'root',
       'charset'   => 'utf8',
       'collation' => 'utf8_unicode_ci',
       'prefix'    => '' ];

$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection( $config );
$db->setAsGlobal();
$db->bootEloquent();
TweeterView::setStyleSheet(['html/style.css']);
TweeterView::setAppTitle("minitwitter");

$router= new Router();

$router->addRoute('home',    '/home/',         '\tweeterapp\control\TweeterController', 'viewHome');
$router->addRoute('view',    '/view/',         '\tweeterapp\control\TweeterController', 'viewTweet');
$router->addRoute('user',    '/user/',         '\tweeterapp\control\TweeterController', 'viewUserTweets');

$router->addRoute('post',    '/post/',         '\tweeterapp\control\TweeterController', 'viewNewTweet');


$router->addRoute('send',    '/send/',         '\tweeterapp\control\TweeterController', 'viewSendTweet');

$router->addRoute('login',    '/login/',         '\tweeterapp\control\TweeterController', 'viewLogin');

$router->addRoute('checklogin',    '/checklogin/',         '\tweeterapp\control\TweeterController', 'viewVerifyLogin');

$router->addRoute('signup',    '/signup/',         '\tweeterapp\control\TweeterController', 'viewSignup');

$router->addRoute('check_signup',    '/check_signup/',         '\tweeterapp\control\TweeterController', 'viewCheckSignup');

$router->addRoute('logout',    '/logout/',         '\tweeterapp\control\TweeterController', 'viewLogout');

$router->addRoute('default', 'DEFAULT_ROUTE',  '\tweeterapp\control\TweeterController', 'viewHome');

$router->run();






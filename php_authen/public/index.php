<?php
require('../vendor/autoload.php');

use \App\{
  User,
  admin,
  Auth
};

$router = new AltoRouter();


$loadRoute = function ($pageName, $callback = null) {
  new Auth();

  $pdo = new PDO("sqlite:../data.sqlite", null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ]);

  if(is_callable($callback)) {
    $callback() ;
  }

  $users = $pdo->query('SELECT * FROM users')->fetchAll();

  require $pageName;
};



$router->map('GET', '/', function() use ($loadRoute) {
  $loadRoute('../views/home.php');
});


$router->map('GET', '/singin', function( ) use ($loadRoute) {
  $loadRoute('../views/register.php');
});

$router->map('GET', '/singup', function( ) use ($loadRoute) {
  $loadRoute('../views/register.php');
});

$router->map('GET','/admin', function() use ($loadRoute) {
  $loadRoute('../views/admin.php');
});

$router->map('GET', '/user', function() use ($loadRoute) {
  $loadRoute('../views/user.php');
});

$match = $router->match();

if ($match) {
    call_user_func_array($match['target'], $match['params']);
} else {
};
?>

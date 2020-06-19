<?php

// $router->get('/phpmaster', function(){
//   return "hello world";
// });
$router->controller('/phpmaster', \App\Controllers\frontend\HomeController::class);
$router->controller('/phpmaster/user', \App\Controllers\frontend\UserController::class);
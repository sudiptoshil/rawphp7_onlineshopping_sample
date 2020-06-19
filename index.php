<?php

use Phroute\Phroute\Dispatcher;

use Phroute\Phroute\Exception\HttpMethodNotAllowedException;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\RouteParser;
use Respect\Validation\Validator;

// define('BASE_URL', 'php-shop');
require_once "vendor/autoload.php";
session_start();
// database configuration
require_once __DIR__."/database/database.php";
// end database configuration

$router = new RouteCollector(new RouteParser());

require_once __DIR__ ."/routes.php";

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
try {
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'],

    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

}   catch (HttpRouteNotFoundException $e) {

    echo $e->getMessage();

    die();
} catch (HttpMethodNotAllowedException $e) {

    echo $e->getMessage();

    die();
}
echo $response;
?>







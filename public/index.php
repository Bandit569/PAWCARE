<?php

require_once dirname(__DIR__).'/src/Classes/Httprequest.php';
require_once '../src/Classes/Router.php';
require_once '../src/Classes/Route.php';

use Classes\Httprequest;
use Classes\Router;

$configFile = file_get_contents("../src/Config/Config.json");
$config = json_decode($configFile);

spl_autoload_register(function ($class) use ($config) {
    foreach ($config->{'AutoloadFolder'} as $folder) {
        if (file_exists($folder . '/' . $class . '.php')) {
            require_once(dirname(__DIR__).$folder . '/' . $class . '.php');
            break;
        }
    }
});

try {
    $router = new Router();
    $Httprequest = new Httprequest();
    $Httprequest->setRoute($router->findRoute($Httprequest));
    $Httprequest->run($config);
} catch (Exception $e) {
    $Httprequest = new Httprequest('/PAWCARE/MyError','GET');
    $Router = new Router();
    $Httprequest->setRoute($Router->findRoute($Httprequest));
    $Httprequest->addParam($e);
    $Httprequest->run($config);
}


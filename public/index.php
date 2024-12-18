<?php


use Classes\Router;
use Classes\Httprequest;


//require_once dirname(__DIR__).'/src/Classes/Httprequest.php';
//require_once '../src/Classes/Router.php';
//require_once '../src/Classes/Route.php';



$configFile = file_get_contents("../src/Config/Config.json");
$config = json_decode($configFile);

spl_autoload_register(function ($class) use ($config) {
    foreach ($config->{'AutoloadFolder'} as $folder) {
        if (file_exists(
            str_replace('/',DIRECTORY_SEPARATOR,dirname(__DIR__).'/'.$folder.DIRECTORY_SEPARATOR.$class.'.php'))
        ) {
            require_once(str_replace('/',DIRECTORY_SEPARATOR,dirname(__DIR__).'/'.$folder.DIRECTORY_SEPARATOR.$class.'.php'));
            //echo str_replace('/',DIRECTORY_SEPARATOR,dirname(__DIR__).'/'.$folder.DIRECTORY_SEPARATOR.$class.'.php') . " exists";
            break;
        }
        else{
        echo "Trying: " . str_replace('/', DIRECTORY_SEPARATOR, dirname(__DIR__) . '/' . $folder . DIRECTORY_SEPARATOR . $class . '.php') . PHP_EOL;

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


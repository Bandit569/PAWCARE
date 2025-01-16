<?php

/**
 * A basic routing class to handle HTTP requests.
 */

namespace Classes;

use Classes\Exceptions\ActionNotFoundException;
use Classes\Exceptions\ControllerNotFoundException;



//require_once(dirname(__FILE__)."/Exceptions/ControllerNotFoundException.php");
//require_once(dirname(__FILE__)."/Exceptions/ActionNotFoundException.php");


/**
 * This class is responsible for managing and handling HTTP routes.json.
 */
class Route
{
    private string $_path;
    private string $_controller;
    private string $_action;
    private string $_method;
    private array $_param;


    public function __construct($route)
    {
        $this->_path = $route->path;
        $this->_controller = $route->controller;
        $this->_action = $route->action;
        $this->_method = $route->method;
        $this->_param = $route->param;
    }

    public function getPath(): string
    {
        return $this->_path;
    }

    public function getController(): string
    {
        return $this->_controller;
    }

    public function getAction(): string
    {
        return $this->_action;
    }

    public function getMethod(): string
    {
        return $this->_method;
    }

    public function getParam(): array
    {
        return $this->_param;
    }

    public function run($httpRequest,$config): void
    {
        $_controller = null;
        $controllerName = $this->_controller;
        //include_once(dirname(__DIR__)."/Controllers/".$controllerName.".php");
        if(class_exists("\\Controllers\\".$controllerName))
        {
            $controllerClass = "\\Controllers\\".$controllerName;
            $controller = new $controllerClass($httpRequest,$config);
            if(method_exists($controller, $this->_action))
            {
                $controller->{$this->_action}(...$httpRequest->getParam());
            }
            else
            {
                throw new ControllerNotFoundException();
            }
        }
        else
        {
            throw new ActionNotFoundException();
        }

    }
}
<?php

/**
 * Base controller class to handle HTTP requests and manage views and binding.
 */

namespace Controllers;

require_once dirname(__DIR__) . "/Classes/Exceptions/ViewNotFoundException.php";

use AllowDynamicProperties;
use \Classes\Exceptions\ViewNotFoundException;

#[AllowDynamicProperties] class BaseController
{
    private $_httpRequest;
    private $_param;

    public function __construct($httpRequest)
    {
        $this->_httpRequest = $httpRequest;
        $this->_config = $httpRequest;
        $this->_param = array();
        $this->addParam("httprequest", $this->_httpRequest);
        $this->addParam("config", $this->_config);
    }

    protected function view($filename): void
    {
        if(file_exists(dirname(__DIR__).'/Views/' . $filename . '.php'))
        {
            ob_start();
            extract($this->_param);
            include(dirname(__DIR__)."/Views/" .  $filename . ".php");
            $content = ob_get_clean();
            echo $content;
            //include(dirname(__DIR__)."/Views/layout.php");
        }
        else
        {
            throw new ViewNotFoundException();
        }
    }


    public function addParam($name,$value): void
    {
        $this->_param[$name] = $value;
    }
}
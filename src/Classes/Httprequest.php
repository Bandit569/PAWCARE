<?php

/**
 * Class Httprequest
 * This class handles HTTP requests, extracting URL, method, and parameters.
 */

namespace Classes;
class Httprequest
{
    private $_url;
    private $_method;
    private $_param;
    private $_route;

    public function __construct($url = null, $method = null)
    {
        $this->_url = (is_null($url) ? $_SERVER['REQUEST_URI'] : $url);
        $this->_method = (is_null($method))?$_SERVER['REQUEST_METHOD']:$method;
        $this->_param = array();
    }

    public function getUrl()
    {
        return $this->_url;
    }

    public function getMethod()
    {
        return $this->_method;
    }

    public function getParam(): array
    {
        return $this->_param;
    }

    public function getRoute(){
        return $this->_route;
    }

    public function setRoute($route): void
    {
        $this->_route = $route;
    }
    public function run($config): void
    {
        $this->_route->run($this,$config);
    }
    public function addParam($value): void
    {
        $this->_param[] = $value;
    }
    public function bindParam(): void
    {
        switch ($this->_method) {
            case "GET":
            case "DELETE":
                if (preg_match("#" . $this->_route->path . "#", $this->_url, $matches)) {
                    for ($i = 1; $i < count($matches) - 1; $i++) {
                        $this->_param[] = $matches[$i];
                    }
                }
            case "POST":
            case "PUT":
                foreach ($this->_route->getParam() as $param) {
                    if (isset($_POST[$param])) {
                        $this->_param[] = $_POST[$param];
                    }
                }
        }
    }
}
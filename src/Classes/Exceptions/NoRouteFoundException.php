<?php

namespace Classes\Exceptions;

use Exception;

class NoRouteFoundException extends Exception
{

    public function __construct($message = "No route found")
    {
        parent::__construct($message,0002);
    }
}
<?php

namespace Classes\Exceptions;

use Exception;

class MultipleRouteFoundException extends Exception
{

    public function __construct($message = "More than one route matched the request.")
    {
        parent :: __construct($message,0001);
    }
}
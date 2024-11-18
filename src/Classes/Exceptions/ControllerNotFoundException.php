<?php

namespace Classes\Exceptions;

class ControllerNotFoundException extends \Exception
{

    public function __construct()
    {
        parent::__construct("Controller not found",0005);
    }
}
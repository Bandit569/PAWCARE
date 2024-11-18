<?php

namespace Classes\Exceptions;

class ActionNotFoundException extends \Exception
{

    public function __construct()
    {
        parent::__construct("Action not found",0004);
    }
}
<?php

namespace Classes\Exceptions;

class ViewNotFoundException extends \Exception
{

    public function __construct()
    {
        parent::__construct("View not found",0003);
    }
}
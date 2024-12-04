<?php

namespace Classes\Exceptions;

class DatabaseConnectionFailedException extends \Exception
{

    public function __construct()
    {
        parent::__construct("Database connection failed",0005);
    }
}
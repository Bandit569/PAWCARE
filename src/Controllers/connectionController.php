<?php

namespace Controllers;

use Classes\Exceptions\ViewNotFoundException;

class connectionController extends BaseController
{

    /**
     * @throws ViewNotFoundException
     */
    public function load(){
        $this ->view("connection.php");
    }

}
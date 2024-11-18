<?php

namespace Controllers;

use Classes\Exceptions\ViewNotFoundException;
use Controllers\BaseController;

require_once "BaseController.php";

class MyError extends BaseController
{
    /**
     * @throws ViewNotFoundException
     */
    public function Show($exception): void
    {
        $this->addParam("exception",$exception);
        $this->view("MyError");
    }

}
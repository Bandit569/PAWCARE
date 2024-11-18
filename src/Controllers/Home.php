<?php

namespace Controllers;

use Classes\Exceptions\ViewNotFoundException;

require_once "BaseController.php";

class Home extends BaseController
{
    /**
     * @throws ViewNotFoundException
     */
    public function Home(): void
    {
        $this->view("home");
    }
}
<?php

namespace Controllers;

use Classes\Exceptions\ViewNotFoundException;
use Controllers\BaseController;

require_once "BaseController.php";

class petOwnerSearch extends BaseController
{
    /**
     * @throws ViewNotFoundException
     */
    function petOwnerSearch(): void
    {
        $this->view("petOwnerSearch");
    }
}
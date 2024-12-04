<?php

namespace Controllers;

require_once "BaseController.php";

use Classes\Exceptions\ViewNotFoundException;
use Controllers\BaseController;



class Request extends BaseController
{
    /**
     * @throws ViewNotFoundException
     */
    public function Request(): void
    {
        $this->view("Request");
    }

}
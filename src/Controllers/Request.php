<?php

namespace Controllers;

require_once "BaseController.php";

use Controllers\BaseController;



class Request extends BaseController
{
    public function Request(){
        $this->view("Request");
    }

}
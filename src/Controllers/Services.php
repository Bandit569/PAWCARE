<?php

namespace Controllers;

require_once "BaseController.php";

use Controllers\BaseController;

class Services extends BaseController
{
    public function Services(){
        $this->view("Services");
    }
}
<?php

namespace Controllers;

use Classes\Exceptions\ViewNotFoundException;
use Controllers\BaseController;
use Models\ServiceRequestModel;


class petOwnerSearch extends BaseController
{
    /**
     * @throws ViewNotFoundException
     */
    function petOwnerSearch(): void
    {

         $serviceRequestModel = new ServiceRequestModel();
         $listings = $serviceRequestModel -> PetOwnerSearchGetter();
         $this -> addParam("listings", $listings);
         $this->view("petOwnerSearch");
    }
}
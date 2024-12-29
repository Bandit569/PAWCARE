<?php

namespace Controllers;

use Classes\Exceptions\ViewNotFoundException;
use Controllers\BaseController;
use Models\ServiceRequestModel;
use Models\ServiceTypeModel;


class petOwnerSearch extends BaseController
{
    /**
     * @throws ViewNotFoundException
     *
     *
     */
    function petOwnerSearch(): void
    {

         $serviceRequestModel = new ServiceRequestModel();
         $listings = $serviceRequestModel -> PetOwnerSearchGetter();
         $ServiceTypeModel = new ServiceTypeModel();
         $serviceTypes = $ServiceTypeModel -> getServiceTypes();
         $this-> addParam("services", $serviceTypes);
         $this -> addParam("listings", $listings);
         $this->view("petOwnerSearch");
    }
}
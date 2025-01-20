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
        $filters = array();

        if (isset($_GET["country"])) {
            $filters["country"] = $_GET["country"];
        }
        if (isset($_GET["town"])) {
            $filters["town"] = $_GET["town"];
        }
        if (isset($_GET["order"])) {
            $filters["order"] = $_GET["order"];
        }
        if (isset($_GET["rating"])) {
            $filters["rating"] = $_GET["rating"];
        }




         $serviceRequestModel = new ServiceRequestModel();
         $listings = $serviceRequestModel -> PetOwnerSearchGetter($filters);
         $ServiceTypeModel = new ServiceTypeModel();
         $serviceTypes = $ServiceTypeModel -> getServiceTypes();
         $this-> addParam("services", $serviceTypes);
         $this -> addParam("listings", $listings);
         $this->view("petOwnerSearch");
    }
}
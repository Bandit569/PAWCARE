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

    /**
     * @throws ViewNotFoundException
     */
    public function accept(): void
    {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        if(!isset($_SESSION['user']['id'])){
            $message = "Not logged in";
        }
        else{
            $serviceRequestModel = new ServiceRequestModel();
            if($serviceRequestModel->acceptRequest($_SESSION['user']['id'],$_POST['id'])){
                $message = "Request accepted";
            }
            else{
                $message = "Request not accepted";
            }
        }
        $this -> addParam("message", $message);
        $this -> petOwnerSearch();
    }
}
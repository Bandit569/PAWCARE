<?php

namespace Controllers;

use Controllers\BaseController;
use Models\ServiceRequestModel;

class ServiceRequestController extends BaseController
{

    public function submitRequest(): void
    {
        $serviceRequestModel = new ServiceRequestModel();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize and validate input data
            $data = [
                'userID' => $_POST['userID'],
                'requestType' => $_POST['requestType'],
                'serviceTypeID' => $_POST['serviceTypeID'],
                'date' => $_POST['date'],
                'time' => $_POST['time'],
                'addressID' => $_POST['addressID']
            ];

            if ($this->validateData($data)) {
                $serviceRequestModel->addServiceRequest($data);
                header('Location: success.php');
                exit();
            } else {
                echo "Validation failed. Please check your input.";
            }
        }
        $this->view('Request');
    }

    private function validateData($data)
    {
        // Basic validation: Check if required fields are not empty
        foreach ($data as $key => $value) {
            if (empty($value)) {
                return false;
            }
        }
        return true;
    }

    /*
    $controller = new ServiceRequestController();
    if ($_GET['action'] === 'submitRequest') {
        $controller->submitRequest();
    }*/

}
<?php

namespace Controllers;

use Controllers\BaseController;
use Exception;
use Models\ServiceRequestModel;
use DateTime;

class ServiceRequestController extends BaseController
{
    public function renderRequestForm(): void
    {
        session_start();
        // Fetch user ID from session
        if (!isset($_SESSION['user']['id'])) {
            echo "User not logged in.";
            return;
        }
        $userID = $_SESSION['user']['id'];
        $serviceRequestModel = new ServiceRequestModel();

        // Fetch data for dropdowns
        $pets = $serviceRequestModel->getPetsByUserId($userID);

        if (empty($pets)) {
            $this->view("AddPetForm");
            return;
        }

        $serviceTypes = $serviceRequestModel->getServiceTypes();
        $addresses = $serviceRequestModel->getAddressesByUserId($userID);


        $data = [
            'userID' => $userID,
            'pets' => $pets,
            'serviceTypes' => $serviceTypes,
            'addresses' => $addresses,
        ];

        $this->addParam("data",$data);
        $this->view("Request");
        // Pass the collected data to the view
    }

    public function renderOfferForm(): void
    {
        session_start();
        // Fetch user ID from session
        if (!isset($_SESSION['user']['id'])) {
            echo "User not logged in.";
            return;
        }
        $userID = $_SESSION['user']['id'];
        $serviceRequestModel = new ServiceRequestModel();

        // Fetch data for dropdowns
        //$pets = $serviceRequestModel->getPetsByUserId($userID);
        $serviceTypes = $serviceRequestModel->getServiceTypes();
        $addresses = $serviceRequestModel->getAddressesByUserId($userID);

        $data = [
            'userID' => $userID,
            'serviceTypes' => $serviceTypes,
            'addresses' => $addresses,
        ];

        $this->addParam("data",$data);
        $this->view("Offers");
        // Pass the collected data to the view
    }

    public function submitRequest(): void
    {
        try {
            $serviceRequestModel = new ServiceRequestModel();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                session_start();
                // Validate session user ID
                if (!isset($_SESSION['user']['id'])) {
                    throw new Exception("User not logged in.");
                }

                //echo $_POST['petIds'];
                // Grab input fields from POST
                $date = $_POST['date'];
                $time = $_POST['time'];
                $datetime = new DateTime("$date $time");
                $formatteddate = $datetime->format('Y-m-d H:i:s');

                $data = [
                    'userID' => $_SESSION['user']['id'],
                    'requestType' => $_POST['requestType'] ?? null,
                    'serviceTypeID' => $_POST['serviceTypeID'] ?? null,
                    'date' => $formatteddate ?? null,
                    'addressID' => $_POST['addressID'] ?? null,
                    'petId' => $_POST['petId'] ?? null
                ];


                //var_dump($data);
                // Validate input data
                if (!$this->validateData($data)) {

                } else {

                    // Add service request to the database
                    $serviceRequestModel = new ServiceRequestModel();
                    $result = $serviceRequestModel->addServiceRequest($data);

                    //echo $result;
                    if ($result) {

                        echo "<script>alert('Request saved successfully');</script>";
                        // Redirect to Home on success
                        //header('Location: /Home');
                        $this->view('Home');
                        exit();
                    } else {
                        throw new Exception("Failed to add service request.");
                    }
                }
            }

        }
        catch
            (Exception $e) {
                // Log the exception and display an error
                error_log($e->getMessage());
                echo "Something went wrong: " . $e->getMessage();
            }
    }


    public function submitOffer(): void
    {
        try {
            $serviceRequestModel = new ServiceRequestModel();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                session_start();
                // Validate session user ID
                if (!isset($_SESSION['user']['id'])) {
                    throw new Exception("User not logged in.");
                }

                //echo $_POST['petIds'];
                // Grab input fields from POST
                $date = $_POST['date'];
                $time = $_POST['time'];
                $datetime = new DateTime("$date $time");
                $formatteddate = $datetime->format('Y-m-d H:i:s');

                $data = [
                    'userID' => $_SESSION['user']['id'],
                    'requestType' => $_POST['requestType'] ?? null,
                    'serviceTypeID' => $_POST['serviceTypeID'] ?? null,
                    'date' => $formatteddate ?? null,
                    'addressID' => $_POST['addressID'] ?? null
                ];


                //var_dump($data);
                // Validate input data
                if (!$this->validateData($data)) {

                } else {

                    // Add service request to the database
                    $serviceRequestModel = new ServiceRequestModel();
                    $result = $serviceRequestModel->addServiceOffer($data);

                    //echo $result;
                    if ($result) {

                        echo "<script>alert('Request saved successfully');</script>";
                        // Redirect to Home on success
                        //header('Location: /Home');
                        $this->view('Home');
                        exit();
                    } else {
                        throw new Exception("Failed to add service request.");
                    }
                }
            }

        }
        catch
        (Exception $e) {
            // Log the exception and display an error
            error_log($e->getMessage());
            echo "Something went wrong: " . $e->getMessage();
        }
    }

    public function addPet(): void
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                session_start();

                // Validate session user ID
                if (!isset($_SESSION['user']['id'])) {
                    throw new Exception("User not logged in.");
                }

                $userID = $_SESSION['user']['id'];

                // Collect pet details from POST request
                $data = [
                    'userID' => $userID,
                    'petName' => $_POST['petName'] ?? null,
                    'petSpecies' => $_POST['petSpecies'] ?? null,
                    'petBreed' => $_POST['petBreed'] ?? null,
                    'petAge' => $_POST['petAge'] ?? null,
                    'petMedication' => $_POST['petMedication'] ?? null,
                    'petAdditionalInfo' => $_POST['petAdditionalInfo'] ?? null
                ];

                // Basic validation
                foreach ($data as $key => $value) {
                    if (empty($value)) {
                        throw new Exception("Field {$key} must not be empty.");
                    }
                }

                // Use the model to save pet data to the database
                $serviceRequestModel = new ServiceRequestModel();
                $result = $serviceRequestModel->addPet($data);

                if ($result) {
                    //echo "<script>alert('Pet added successfully!');</script>";
                    // Redirect to the same page or any relevant page
                    //header('/PAWCARE/LoadRequest');
                    //$this->view('/PAWCARE/Request');
                    $this->renderRequestForm();
                    //echo "<script>location.reload();</script>";
                    exit();
                } else {
                    throw new Exception("Failed to add pet details.");
                }
            }
        } catch (Exception $e) {
            // Log the exception and show an error message
            error_log($e->getMessage());
            echo "Something went wrong: " . $e->getMessage();
        }
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
}
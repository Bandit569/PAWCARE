<?php

namespace Models;

use DateTime;
use Entities\AddressEntity;
use Entities\ServiceRequestEntity;
use PDO;


class ServiceRequestModel
{
    private string $table;
    private PDO $conn;

    public function __construct()
    {
        $this->conn = DatabaseConnection::getInstance();
        $this->table = "service_request";
    }

    public function getServiceRequestById(int $id): ?\Entities\ServiceRequestEntity
    {
        $req = $this->conn->query("SELECT * FROM $this -> table WHERE id = $id");
        $req->execute(array($id));

        $req->bindColumn("service_request_id", $id);
        $req->bindColumn("user_id", $userId);
        $req->bindColumn("service_type_id", $serviceTypeId);
        $req->bindColumn("request_type", $requestTypeId);
        $req->bindColumn("date", $date);
        $req->bindColumn("request_status", $status);
        $req->bindColumn("address_id", $addressId);
        $req->bindColumn("acceptor_id", $acceptorId);
        $req->bindColumn("price", $price);
        $req->bindColumn("description", $description);
        $addressModel = new AddressModel();
        $date2 = new DateTime($date);
        $address = $addressModel->getAddressById($addressId);
        if (!isset($address)) {
            $address = new AddressEntity($addressId, 0, "ERROR", "ERROR", "ERROR", $userId);
        }

        if ($req->fetch(PDO::FETCH_BOUND)) {
            return new ServiceRequestEntity($id, $date2, $status, $requestTypeId, $serviceTypeId, $address, $description, $price, $userId, $acceptorId);
        }
        return null;
    }

    public function PetOwnerSearchGetter(): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE acceptor_id IS NULL AND request_type != :excludedType");
        $excludedType = 1; // Service request type to exclude
        $stmt->bindParam(':excludedType', $excludedType, PDO::PARAM_INT);
        $stmt->execute();

        $serviceRequests = [];

        // Bind columns to PHP variables
        $stmt->bindColumn("service_request_id", $id);
        $stmt->bindColumn("user_id", $userId);
        $stmt->bindColumn("service_type_id", $serviceTypeId);
        $stmt->bindColumn("request_type", $requestTypeId);
        $stmt->bindColumn("date", $date);
        $stmt->bindColumn("request_status", $status);
        $stmt->bindColumn("address_id", $addressId);
        $stmt->bindColumn("acceptor_id", $acceptorId);
        $stmt->bindColumn("price", $price);
        $stmt->bindColumn("description", $description);

        $addressModel = new AddressModel();;
        $date2 = new DateTime($date);

        // Fetch all results
        while ($stmt->fetch(PDO::FETCH_BOUND)) {

            $Userm = new UserModel();
            $usere = $Userm->getUserById($userId);


            $address = $addressModel->getAddressById($addressId);
            if (!isset($address)) {
                $address = new AddressEntity($addressId, 0, "ERROR", "ERROR", "ERROR", $userId);
            }
            if (!isset($description)) {
                $description = "No Description provided";
            }
            // Create and store the ServiceRequestEntity object
            $serviceRequests[] = new ServiceRequestEntity(
                $id,
                $date2,
                $status,
                $requestTypeId,
                $serviceTypeId,
                $address,
                $description,
                $price,
                $usere,
            );
        }

        return $serviceRequests;
    }


    // Add a new service request

    public function addServiceRequest(array $data): bool
    {
        $sql = "INSERT INTO service_request (user_id, request_type, service_type_id, date, address_id, request_status)
            VALUES (:userID, :requestType, :serviceTypeID, :date, :addressID, :requestStatus)";

        $stmt = $this->conn->prepare($sql);
        $requestStatus = "New";
        $stmt->execute([
            ':userID' => $data['userID'],               // Matches the :userID placeholder
            ':requestType' => $data['requestType'],     // Matches the :requestType placeholder
            ':serviceTypeID' => $data['serviceTypeID'], // Matches the :serviceTypeID placeholder
            ':date' => $data['date'],                  // Matches the :date placeholder
            ':addressID' => $data['addressID'],        // Matches the :addressID placeholder
            'requestStatus' => $requestStatus // Matches the :requestStatus placeholder
        ]);
        // Get the last inserted ID
        $serviceRequestId = $this->conn->lastInsertId();
        if ($serviceRequestId) {
            $petId = $data['petId'];
            // Insert into request_pet_link table
            $linkSql = "INSERT INTO request_pet_link (service_request_id, pet_id) VALUES (:serviceRequestId, :petId)";
            $linkStmt = $this->conn->prepare($linkSql);
            try {
                $linkStmt->execute([
                    ':serviceRequestId' => $serviceRequestId,
                    ':petId' => $petId,
                ]);
                //echo "Service request added successfully!";
                return true; // Return true if all operations succeeded
            } catch (PDOException $e) {
                error_log("Error linking pet IDs: " . $e->getMessage());
                throw $e; // Re-throw to debug further, or handle gracefully
            }
        }
        return false;
    }

    public function addServiceOffer(array $data): bool
    {
        $sql = "INSERT INTO service_request (user_id, request_type, service_type_id, date, address_id, request_status)
            VALUES (:userID, :requestType, :serviceTypeID, :date, :addressID, :requestStatus)";

        $stmt = $this->conn->prepare($sql);
        $requestStatus = "New";
        try {
        $stmt->execute([
            ':userID' => $data['userID'],               // Matches the :userID placeholder
            ':requestType' => $data['requestType'],     // Matches the :requestType placeholder
            ':serviceTypeID' => $data['serviceTypeID'], // Matches the :serviceTypeID placeholder
            ':date' => $data['date'],                  // Matches the :date placeholder
            ':addressID' => $data['addressID'],        // Matches the :addressID placeholder
            'requestStatus' => $requestStatus // Matches the :requestStatus placeholder
        ]);
                //echo "Service request added successfully!";
                return true; // Return true if all operations succeeded
            } catch (PDOException $e) {
                error_log("Error linking pet IDs: " . $e->getMessage());
                throw $e; // Re-throw to debug further, or handle gracefully
            }

        return false;
    }

    public function getPetsByUserId(int $userID): array
    {
        // Query to fetch pets for a specific user
        $stmt = $this->conn->prepare("SELECT pet_id, pet_name FROM pets WHERE user_id = :userID");
        $stmt->execute(['userID' => $userID]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Debug the results to verify data is fetched correctly
        if (empty($results)) {
            error_log("No pets found for User ID: $userID");
        } else {
            error_log("Pets fetched for User ID $userID: " . print_r($results, true));
        }

        return $results;
    }

    public function getServiceTypes(): array
    {
        // Query to fetch all service types
        $stmt = $this->conn->query("SELECT service_type_id, service_type_name FROM service_type");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAddressesByUserId(int $userID): array
    {
        // Query to fetch addresses for the given user
        $stmt = $this->conn->prepare("SELECT address_id, address_flat_no FROM addresses WHERE address_user_id = :userID");
        $stmt->execute(['userID' => $userID]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Debug the output
        if (empty($results)) {
            error_log("No addresses found for User ID: $userID");
        } else {
            error_log("Addresses fetched for User ID $userID: " . print_r($results, true));
        }

        return $results;
    }

    public function addPet($data): bool
    {
        $query = "INSERT INTO pets (user_id, pet_name, pet_species, pet_breed, pet_age, pet_medication, pet_additional_info) 
              VALUES (:userID, :petName, :petSpecies, :petBreed, :petAge, :petMedication, :petAdditionalInfo)";

        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':userID', $data['userID']);
        $stmt->bindParam(':petName', $data['petName']);
        $stmt->bindParam(':petSpecies', $data['petSpecies']);
        $stmt->bindParam(':petBreed', $data['petBreed']);
        $stmt->bindParam(':petAge', $data['petAge']);
        $stmt->bindParam(':petMedication', $data['petMedication']);
        $stmt->bindParam(':petAdditionalInfo', $data['petAdditionalInfo']);

        return $stmt->execute();
    }

}
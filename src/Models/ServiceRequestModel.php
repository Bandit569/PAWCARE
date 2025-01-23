<?php

namespace Models;

use DateTime;
use Entities\AddressEntity;
use Entities\ServiceRequestEntity;
use Entities\UserEntity;
use Entities\UserTypeEntity;
use PDO;
use Entities\PetEntity;
use Models\PetModel;


class ServiceRequestModel
{
    private string $table;
    private PDO $conn;
    public function __construct()
    {
        $this->conn = DatabaseConnection::getInstance();
        $this->table = "service_request";
    }

    /**
     * @param int $id
     * @return ServiceRequestEntity|null
     * @throws \DateMalformedStringException
     *
     * @TODO Not up to date
     */
    public function getServiceRequestById(int $id): ?\Entities\ServiceRequestEntity
    {
        $req = $this -> conn -> query("SELECT * FROM $this -> table WHERE id = $id");

        $req -> execute(array($id));

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
        $address  = $addressModel -> getAddressById($addressId);

        if(!isset($address)){
            $address = new AddressEntity($addressId,0,"ERROR","ERROR","ERROR",$userId);
        }

        if ($req -> fetch(PDO::FETCH_BOUND)){
            return new ServiceRequestEntity($id,$date2,$status,$requestTypeId,$serviceTypeId,$address,$description,$price,$userId,$acceptorId);
        }
        return null;
    }

    public function PetOwnerSearchGetter($filters): array
    {
        $stmt = $this->conn->prepare($this -> buildSearchQuery($filters));
        $excludedType = 1; // Service request type to exclude
        $stmt->bindParam(':excludedType', $excludedType, PDO::PARAM_INT);
        if(!empty($filters['country'])){
            $stmt->bindParam(':country', $filters['country']);
        }
        if(!empty($filters['town'])){
            $stmt->bindParam(':town', $filters['town']);
        }
        if(!empty($filters['rating'])){
            $stmt->bindParam(':rating', $filters['rating']);
        }

        $stmt->execute();

        $serviceRequests = [];

        // Bind columns to PHP variables

        $stmt -> bindColumn("service_request_id", $id);
        $stmt -> bindColumn("user_id",$userId);
        $stmt -> bindColumn("service_type_id",$serviceTypeId);
        $stmt -> bindColumn("request_type",$requestTypeId);
        $stmt -> bindColumn("date",$date);
        $stmt -> bindColumn("request_status",$status);
        $stmt -> bindColumn("address_id",$addressId);
        $stmt -> bindColumn("acceptor_id",$acceptorId);

        $addressModel = new AddressModel();;
        $date2 = new DateTime($date);

        // Fetch all results
        while ($stmt->fetch(PDO::FETCH_BOUND)) {

            $Userm = new UserModel();
            $usere = $Userm -> getUserById($userId);



            $address = $addressModel->getAddressById($addressId);
            if(!isset($address)){
                $address = new AddressEntity($addressId,0,"ERROR","ERROR","ERROR",$userId);
            }



            // Create and store the ServiceRequestEntity object
            $serviceRequests[] = new ServiceRequestEntity(
                $id,
                $date2,
                $status,
                $requestTypeId,
                $serviceTypeId,
                $address,
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
            ':userID' => $data['userID'],
            ':requestType' => $data['requestType'],
            ':serviceTypeID' => $data['serviceTypeID'],
            ':date' => $data['date'],
            ':time' => $data['time'],
            ':addressID' => $data['addressID'],
            'requestStatus' => $requestStatus
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
                ':userID' => $data['userID'],
                ':requestType' => $data['requestType'],
                ':serviceTypeID' => $data['serviceTypeID'],
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

    /**
     * Method to get all service requests
     * @param mixed $search - Search Parameter
     * @param string $userId - User ID
     * @param int $role - User type
     * @return array - Array of service requests
     * @author Leela
     */
    public function getAllServiceRequests($search = "", string $userId, int $role)
    {
        $sql = "SELECT * FROM " . $this->table;

        switch ($role) {
                // Pet Owner
            case 2:
                $sql .= " WHERE user_id = '$userId'";
                if (!empty($search)) {
                    $sql .= " AND (request_type LIKE '$search' OR request_status LIKE '$search')";
                }
                break;
            default:
                if (!empty($search)) {
                    $sql .= " WHERE request_type LIKE '$search' OR request_status LIKE '$search'";
                }
                break;
        }

        $req = $this->conn->query($sql);
        $req->execute();
        $data = $req->fetchAll();
        return $data;
    }

    /**
     * @param array $filters
     * @return string
     *
     * @TODO wThis madness still gives out double the same output sometimes, find out why
     */
    function buildSearchQuery(array $filters): string
    {
        // Start building the query
        $query = "SELECT DISTINCT sr.service_request_id, sr.request_type, sr.date, sr.request_status, 
                     sr.user_id, sr.acceptor_id, sr.service_type_id, sr.address_id";
        $from = "\nFROM service_request sr";
        $join = "\nJOIN rating r ON sr.service_request_id = r.service_request_id";
        $where = "\nWHERE sr.request_type != :excludedType and request_status = 'Pending' ";

        // Add filters for town and country
        if (!empty($filters['town']) || !empty($filters['country'])) {
            $join .= "\nJOIN addresses a ON sr.user_id = a.address_user_id";
            if (!empty($filters['town'])) {
                $where .= " AND a.address_town LIKE :town";
            }
            if (!empty($filters['country'])) {
                $where .= " AND a.address_country = :country";
            }
        }


        if (!empty($filters['rating'])) {
            $query .= " AND r.rating >= :rating";
        }


        $order = "";
        if (!empty($filters['order'])) {
            switch ($filters['order']) {
                case 1:
                    $order = " ORDER BY r.rating DESC";
                    break;
                case 2:
                    $order = " ORDER BY r.rating ASC";
                    break;
                case 3:
                    $join .= "\nJOIN user_details ud ON ud.user_id = sr.user_id";
                    $order = " ORDER BY ud.user_first_name ASC";
                    break;
                case 4:
                    $join .= "\nJOIN user_details ud ON ud.user_id = sr.user_id";
                    $order = " ORDER BY ud.user_username DESC";
                    break;
            }
        } else {
            $order = " ORDER BY r.rating DESC";
        }

        // Concatenate the query parts
        $query .= $from . $join . $where . $order;

        return $query;
    }
    public function petOwnerManager(): void
    {
        $req = $this -> conn -> query("SELECT * FROM $this -> table");
        $req -> execute();

        $req -> bindColumn("service_request_id", $id);
        $req -> bindColumn("user_id",$userId);
        $req -> bindColumn("service_type_id",$serviceTypeId);
        $req -> bindColumn("request_type",$requestTypeId);
        $req -> bindColumn("date",$date);
        $req -> bindColumn("request_status",$status);
        $req -> bindColumn("address_id",$addressId);
        $req -> bindColumn("acceptor_id",$acceptorId);
        $req -> bindColumn("price",$price);
        $req -> bindColumn("description",$description);
        $um = new UserModel();
        $serviceRequests = array();
        while ($req -> fetch(PDO::FETCH_BOUND)){
            $Userm = new UserModel();
            $usere = $Userm -> getUserById($userId);

            $addressModel = new AddressModel();

            $address = $addressModel->getAddressById($addressId);
            if(!isset($address)){
                $address = new AddressEntity($addressId,0,"ERROR","ERROR","ERROR",$userId);
            }

            $date2 = new DateTime($date);

            $sr = new ServiceRequestEntity(
                $id,
                $date2,
                $status,
                $requestTypeId,
                $serviceTypeId,
                $address,
                $usere,
            );
            if(!empty($acceptorId)){
                $sr -> setAcceptor($um -> getUserById($acceptorId));
            }
            $serviceRequests[] = $sr;


        }
    }

    /**
     * Method to update service request status
     * @param string $service_request_id - Service request ID
     * @param string $status - Status
     * @return bool - True if updated successfully
     * @author: Leela
     */
    public function updateStatus(string $service_request_id, string $status) {
        $sql = "UPDATE " . $this->table . " SET request_status = ? WHERE service_request_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $status);
        $stmt->bindParam(2, $service_request_id);
        return $stmt->execute();
    }

    public function caretakerGetter($filters){
        $stmt = $this->conn->prepare($this -> buildSearchQuery($filters));
        $excludedType = 0; // Service request type to exclude
        $stmt->bindParam(':excludedType', $excludedType, PDO::PARAM_INT);
        if(!empty($filters['country'])){
            $stmt->bindParam(':country', $filters['country']);
        }
        if(!empty($filters['town'])){
            $stmt->bindParam(':town', $filters['town']);
        }
        if(!empty($filters['rating'])){
            $stmt->bindParam(':rating', $filters['rating']);
        }


        $stmt->execute();

        $serviceRequests = [];

        // Bind columns to PHP variables

        $stmt -> bindColumn("service_request_id", $id);
        $stmt -> bindColumn("user_id",$userId);
        $stmt -> bindColumn("service_type_id",$serviceTypeId);
        $stmt -> bindColumn("request_type",$requestTypeId);
        $stmt -> bindColumn("date",$date);
        $stmt -> bindColumn("request_status",$status);
        $stmt -> bindColumn("address_id",$addressId);
        $stmt -> bindColumn("acceptor_id",$acceptorId);

        $addressModel = new AddressModel();;
        $date2 = new DateTime($date);

        $petModel = new PetModel();

        // Fetch all results
        while ($stmt->fetch(PDO::FETCH_BOUND)) {

            $Userm = new UserModel();
            $usere = $Userm -> getUserById($userId);



            $address = $addressModel->getAddressById($addressId);
            if(!isset($address)){
                $address = new AddressEntity($addressId,0,"ERROR","ERROR","ERROR",$userId);
            }

            $sr = new ServiceRequestEntity(
                $id,
                $date2,
                $status,
                $requestTypeId,
                $serviceTypeId,
                $address,
                $usere,
            );
            $petArray = $petModel->getPetByRequestId($id);
            foreach($petArray as $pet){

                $sr->addPet($pet);
            }

            // Create and store the ServiceRequestEntity object
            $serviceRequests[] = $sr;
        }


        return $serviceRequests;
    }


    public function acceptRequest($acceptorId, $serviceRequestId): bool
    {
        $sql = "UPDATE " . $this->table . " SET request_status = 'Completed' ,
        acceptor_id = :acceptor_id
        WHERE service_request_id = :service_request_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":acceptor_id", $acceptorId);
        $stmt->bindParam(":service_request_id", $serviceRequestId);
        return $stmt->execute();
    }
}


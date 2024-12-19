<?php

namespace Models;

use Entities\ServiceTypeEntity;
use PDO;

class ServiceTypeModel
{
    private string $table;
    private PDO $conn;
    public function __construct()
    {
        $this->conn = DatabaseConnection::getInstance();
        $this->table = "service_requests";
    }

    public function getServiceTypes(): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table");
        $stmt->execute();

        $stmt -> bindColumn("service_type_id", $id);
        $stmt -> bindColumn("service_type_name", $name);
        $stmt -> bindColumn("service_type_description", $description);

        $ServiceType = [];

        while($stmt->fetch(PDO::FETCH_BOUND)){
            $ServiceType [] = new ServiceTypeEntity($id, $name, $description);
        }
        return $ServiceType;
    }

    public function getServiceTypeById(int $id): ?ServiceTypeEntity
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE service_type_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Bind columns to PHP variables
        $stmt->bindColumn("service_type_id", $id);
        $stmt->bindColumn("service_type_name", $name);
        $stmt->bindColumn("service_type_description", $description);

        // Fetch the result and create the ServiceTypeEntity object
        if ($stmt->fetch(PDO::FETCH_BOUND)) {
            return new ServiceTypeEntity($id, $name, $description);
        }

        // Return null if no result is found
        return null;
    }

    public function getAllServiceRequests(): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE acceptor_id IS NULL");
        $stmt->execute();

        $serviceRequests = [];

        // Bind columns to PHP variables
        $stmt->bindColumn("serviceRequestId", $id);
        $stmt->bindColumn("userId", $userId);
        $stmt->bindColumn("serviceTypeId", $serviceTypeId);
        $stmt->bindColumn("requestTypeId", $requestTypeId);
        $stmt->bindColumn("date", $date);
        $stmt->bindColumn("time", $time);
        $stmt->bindColumn("requestStatus", $status);
        $stmt->bindColumn("addressId", $addressId);

        $addressModel = new AddressModel();

        // Fetch all results
        while ($stmt->fetch(PDO::FETCH_BOUND)) {
            $address = $addressModel->getAddressById($addressId);

            // Create and store the ServiceRequestEntity object
            $serviceRequests[] = new ServiceRequestEntity(
                $id,
                $date,
                $status,
                $requestTypeId,
                $serviceTypeId,
                $userId,
                $address
            );
        }

        return $serviceRequests;
    }


}
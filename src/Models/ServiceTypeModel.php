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
        $this->table = "service_type";
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




}
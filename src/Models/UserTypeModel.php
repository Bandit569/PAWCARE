<?php

namespace Models;

use Entities\UserTypeEntity;
use PDO;

class UserTypeModel
{
    private string $table;
    private PDO $conn;
    public function __construct()
    {
        $this->conn = DatabaseConnection::getInstance();
        $this->table = "user_type";
    }

    public function getUserTypeById(int $typeId) : ?UserTypeEntity{
        $sql = "SELECT * FROM $this->table WHERE iduser_type = $typeId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindColumn('iduser_type', $typeId);
        $stmt -> bindColumn("user_type_name", $name);
        $stmt -> bindColumn("user_type_description", $description);
        $stmt->execute();
        if($stmt -> fetch(PDO::FETCH_BOUND)){
            return new UserTypeEntity($typeId,$name,$description);
        }
        return null;
    }
}
<?php

namespace Models;

use Entities\AddressEntity;
use PDO;

class AddressModel
{
    private string $table;
    private PDO $conn;
    public function __construct()
    {
        $this->conn = DatabaseConnection::getInstance();
        $this->table = "address";
    }


    /**
     * @param int $id id of the address to fetch
     * @return AddressEntity|null returns an object of type AddressEntity (cf /Entities/AddressEntity)
     */
    public function getAddressById(int $id): ?AddressEntity{
        $query = "SELECT * FROM $this->table WHERE addressID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->bindColumn('addressID', $addressId);
        $stmt->bindColumn('flatNo', $flatNo);
        $stmt->bindColumn('street', $street);
        $stmt->bindColumn('town', $town);
        $stmt->bindColumn('country', $country);
        $stmt->bindColumn('userID', $userId);

        if($stmt -> fetch(PDO::FETCH_BOUND)){
            return new AddressEntity($addressId, $flatNo, $street, $town, $country, $userId);
        }
        return null;
    }
}
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
        $this->table = "addresses";
    }


    /**
     * @param int $id id of the address to fetch
     * @return AddressEntity|null returns an object of type AddressEntity (cf /Entities/AddressEntity)
     */
    public function getAddressById(int $id): ?AddressEntity{
        $query = "SELECT * FROM $this->table WHERE address_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindColumn('address_id', $addressId);
        $stmt->bindColumn('address_flat_no', $flatNo);
        $stmt->bindColumn('address_street', $street);
        $stmt->bindColumn('address_town', $town);
        $stmt->bindColumn('address_country', $country);
        $stmt->bindColumn('address_user_id', $userId);
        if($stmt->execute()){
            if($stmt -> fetch(PDO::FETCH_BOUND)){
                return new AddressEntity($addressId, $flatNo, $street, $town, $country, $userId);
            }
        }

        return null;
    }
}
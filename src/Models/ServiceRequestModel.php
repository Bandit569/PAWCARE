<?php

namespace Models;

use Models\DatabaseConnection;
use PDO;
use Models\ServiceRequestEntity;
use Models\AddressModel;

class ServiceRequestModel
{
    private string $table;
    private PDO $conn;
    public function __construct()
    {
        $this->conn = DatabaseConnection::getInstance();
        $this->table = "service_requests";
    }

    public function getServiceRequestById(int $id): ?\Models\ServiceRequestEntity
    {
        $req = $this -> conn -> query("SELECT * FROM $this -> table WHERE id = $id");
        $req -> execute(array($id));

        $req -> bindColumn("serviceRequestId", $id);
        $req -> bindColumn("userId",$userId);
        $req -> bindColumn("serviceTypeId",$serviceTypeId);
        $req -> bindColumn("requestTypeId",$requestTypeId);
        $req -> bindColumn("date",$date);
        $req -> bindColumn("time",$time);
        $req -> bindColumn("requestStatus",$status);
        $req -> bindColumn("addressId",$addressId);

        $addressModel = new AddressModel();
        $address  = $addressModel -> getAddressById($addressId);

        if ($req -> fetch(PDO::FETCH_BOUND)){
            return new ServiceRequestEntity($id,$date,$status,$requestTypeId,$serviceTypeId,$userId,$address);
        }
        return null;
    }

    // Add a new service request
    public function addServiceRequest($data): false|string
    {
        $sql = "INSERT INTO service_requests (userID, requestType, serviceTypeID, date, time, addressID, requestStatus, acceptorID)
                VALUES (:userID, :requestType, :serviceTypeID, :date, :time, :addressID, :requestStatus, :acceptorID)";

        $this->conn->query($sql, [
            ':userID' => $data['userID'],
            ':requestType' => $data['requestType'],
            ':serviceTypeID' => $data['serviceTypeID'],
            ':date' => $data['date'],
            ':time' => $data['time'],
            ':addressID' => $data['addressID'],
            ':requestStatus' => 'Pending',
            ':acceptorID' => null
        ]);

        return $this->conn->lastInsertId();
    }
}
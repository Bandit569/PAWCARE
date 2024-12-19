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
        $req = $this -> conn -> query("SELECT * FROM $this -> table WHERE id = $id");
        $req -> execute(array($id));

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

    public function PetOwnerSearchGetter(): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE acceptor_id IS NULL AND request_type != :excludedType");
        $excludedType = 1; // Service request type to exclude
        $stmt->bindParam(':excludedType', $excludedType, PDO::PARAM_INT);
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
        $stmt -> bindColumn("price",$price);
        $stmt -> bindColumn("description",$description);

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
            if(!isset($description)){
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

    public function addServiceOffer($data)
    {

    }
}
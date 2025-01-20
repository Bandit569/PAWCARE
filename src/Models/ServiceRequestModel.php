<?php

namespace Models;

use DateTime;
use Entities\AddressEntity;
use Entities\ServiceRequestEntity;
use Entities\UserEntity;
use Entities\UserTypeEntity;
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
        $where = "\nWHERE sr.request_type != :excludedType";

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
}



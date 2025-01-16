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
        if(isset($filters['country'])){
            $stmt->bindParam(':country', $filters['country']);
        }
        if(isset($filters['town'])){
            $stmt->bindParam(':town', $filters['town']);
        }
        if(isset($filters['rating'])){
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
            echo $addressId;
            var_dump($address);
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
     * @TODO work out the correct SQL query for this madness
     */
    function buildSearchQuery(array $filters): string
    {
        $query = "select sr.service_request_id, sr.request_type, sr.date, sr.request_status, sr.user_id, sr.acceptor_id, sr.service_type_id, sr.address_id";
        $from ="\nFrom service_request sr";
        $join = "\njoin rating r on sr.service_request_id = r.service_request_id";
        $where = "\nWHERE request_type != :excludedType";

        $params = [];

        // Add filters
        if (!empty($filters['town'])) {
            $join .= "\njoin addresses a on sr.user_id = a.address_user_id";
            $where .= " AND a.address_town LIKE :town";
            //$params[':town'] = '%' . $filters['town'] . '%'; // Allow partial matches
        }

        if (!empty($filters['country'])) {
            $join .= "\njoin addresses a on sr.user_id = a.address_user_id";
            $where .= " AND a.address_country = :country";
            //$params[':country'] = $filters['country'];
        }

        if (!empty($filters['rating'])) {
            $query .= " AND r.rating >= :rating";
            //$params[':rating'] = (int) $filters['rating'];
        }
        $query .= $from.$join.$where;
        // Sorting
        if (!empty($filters['order'])) {
            switch ($filters['order']) {
                case 1:
                    $query .= " ORDER BY r.rating DESC";
                    break;
                case 2:
                    $query .= " ORDER BY r.rating ASC";
                    break;
                case 3:
                    $join.= "\njoin user_details ud on ud.user_id = r.user_id";
                    $query .= " ORDER BY ud.username ASC";
                    break;
                case 4:
                    $join.= "\njoin user_details ud on ud.user_id = r.user_id";
                    $query .= " ORDER BY ud.username DESC";
                    break;
            }

        }
        else{
            $query .= " ORDER BY r.rating DESC";
        }


        return $query;
    }
}
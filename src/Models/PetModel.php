<?php

namespace Models;

use Entities\PetEntity;
use Models\DatabaseConnection;
use Models\UserModel;
use PDO;
use function Sodium\add;


class PetModel
{
    private string $table;
    private PDO $conn;
    public function __construct()
    {
        $this->conn = DatabaseConnection::getInstance();
        $this->table = "pets";
    }

    public function registerPet($petname, $age, $species, $breed, $medication, $additionalinfo, $imgpath): void
    {
        $sql = "INSERT INTO pets (pet_name, pet_age, pet_species, pet_breed, pet_medication, pet_additional_info, image_path, user_id) VALUES (:petname, :age, :species, :breed, :medication, :additionalinfo, :imgpath, :user_id)";
        $stmt = $this->conn->prepare($sql);
        $user_id = $_SESSION['user_id'];
        $stmt->execute([
            ':pet_name' => $petname,
            ':pet_age' => $age,
            ':pet_species' => $species,
            ':pet_breed' => $breed,
            ':pet_medication' => $medication,
            ':pet_additional_info' => $additionalinfo,
            ':user_id' => $user_id,
        ]);
    }

    public function getPetByRequestId(int $requestId): array
    {
        $sql = "SELECT p.pet_id, p.pet_name, p.pet_age, p.pet_breed, p.pet_species, p.pet_medication, p.pet_additional_info, p.image_path, p.user_id FROM pets p join request_pet_link rpl on rpl.pet_id = p.pet_id where rpl.service_request_id = :request_id";
        //$sql = "select * from pets";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindColumn('pet_id', $petId);
        $stmt->bindColumn('pet_name', $petName);
        $stmt->bindColumn("pet_age", $pet_age);
        $stmt->bindColumn("pet_species", $pet_species);
        $stmt->bindColumn("pet_breed", $pet_breed);
        $stmt->bindColumn("pet_medication", $pet_medication);
        $stmt->bindColumn("pet_additional_info", $pet_additional_info);
        $stmt->bindColumn("image_path", $image_path);
        $stmt->bindColumn("user_id", $user_id);
        $stmt->bindParam(":request_id", $requestId);

        $stmt->execute();
        $array = [];
        while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {
            $pet = new PetEntity($petId,$petName,$pet_breed,$pet_species,$pet_age,$pet_medication,$pet_additional_info,$user_id);

            $array[] = $pet;
        }
        return $array;
    }
}

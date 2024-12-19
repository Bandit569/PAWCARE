<?php

namespace Models;

use Models\DatabaseConnection;
use Models\UserModel;
use PDO;


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

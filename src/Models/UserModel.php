<?php

namespace Models;

use Entities\UserEntity;
use PDO;

class UserModel
{

    private string $table;
    private PDO $conn;
    public function __construct()
    {
        $this->conn = DatabaseConnection::getInstance();
        $this->table = "user_details";
    }

    public function registerUser($firstname, $lastname, $email, $contactno, $username, $password, $role): void
    {
        $sql = "INSERT INTO user_details (user_first_name, user_last_name, user_email, user_contact_number, user_username, user_password, user_type) VALUES (:firstname, :lastname, :email, :contactno, :username, :password, :role)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':user_first_name' => $firstname,
            ':user_last_name' => $lastname,
            ':user_email' => $email,
            ':user_contact_number' => $contactno,
            ':user_username' => $username,
            ':password' => $password,
            ':user_type' => $role,
        ]);
    }

    public function authenticateUser($userid)
    {
        $sql = "SELECT * FROM user_details WHERE user_id =:user_id";
        $stmt = $this->conn->query($sql, [':user_id' => $userid]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById(int $userId): ?UserEntity {
        $sql = "SELECT * FROM $this->table WHERE user_id = :userId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the data as an associative array
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Extract data from the row
            $firstname = $row['user_first_name'] ?? null;
            $lastname = $row['user_last_name'] ?? null;

            $email = $row['user_email'] ?? null;
            $username = $row['user_username'] ?? null;
            $contactno = $row['user_contact_number'] ?? null;
            $userType1 = $row['user_type'] ?? null;

            $userId = $row['user_id'] ?? null;

            // Fetch the user type
            $utm = new UserTypeModel();

            $userType = $utm->getUserTypeById($userType1);


            // Return the UserEntity object
            return new UserEntity($userId, $firstname, $lastname, $email, $username, $userType, $contactno);
        }

        // Return null if no user found
        return null;
    }

}
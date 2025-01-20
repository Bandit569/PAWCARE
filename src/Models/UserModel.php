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

    public function registerUser($firstname, $lastname, $email, $contactno, $username, $password, $usertype): int{
        try {
            // SQL query to insert a new user into the database
            $sql = "INSERT INTO user_details (user_first_name, user_last_name, user_email, user_contact_number, user_username, user_password, user_type) 
                    VALUES (:firstname, :lastname, :email, :contactno, :username, :password, :usertype)";

            // Prepare the SQL statement
            $stmt = $this->conn->prepare($sql);

            // Bind the parameters to prevent SQL injection
            $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
            $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':contactno', $contactno, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR); // Hash the password if needed
            $stmt->bindParam(':usertype', $usertype, PDO::PARAM_INT);
            // Execute the query
            $stmt->execute();

            // Return the ID of the last inserted user
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            // Handle errors (log them or show a user-friendly message)
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }



    public function authenticateUser($userid){
        $sql = "SELECT * FROM user_details WHERE user_username = :user_id";
        $stmt = $this->conn->prepare($sql); // Prepare the SQL statement
        $stmt->execute([':user_id' => $userid]); // Execute with bound parameters
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch and return results
        }

    public function getUserById(int $userId): ?UserEntity {
        $sql = "SELECT * FROM $this->table WHERE user_username = :userId";
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
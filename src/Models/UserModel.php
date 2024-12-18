<?php

namespace Models;

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
}
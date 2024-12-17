<?php

class User extends DatabaseConnection
{
   /* public function registerUser($name, $email, $password)
    {
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $password,
        ]);
    }*/

    public function login($username)
    {
        $sql = "SELECT * FROM user_details WHERE user_username = :username";
        $stmt = $this->__construct()->prepare($sql);
        $stmt->execute([':username' => $username]);
        return $stmt->fetch();
    }
}

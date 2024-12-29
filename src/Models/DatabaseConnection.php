<?php

namespace Models;

use AllowDynamicProperties;
use Classes\Exceptions\DatabaseConnectionFailedException;
use mysqli;
use PDO;

// Define database constants
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'petcare');

/**
 * Class DatabaseConnection
 * Singleton class for establishing a database connection using PDO.
 */
class DatabaseConnection
{
    /**
     * @var PDO $conn The PDO instance representing the database connection.
     */
    private PDO $conn;

    /**
     * @var DatabaseConnection $instance The single instance of DatabaseConnection.
     */
    private static DatabaseConnection $instance;

    /**
     * Private constructor to prevent multiple instances.
     *
     * @throws \PDOException If the connection fails.
     */
    private function __construct()
    {
        $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE, DB_USER, DB_PASSWORD);
    }

    /**
     * Get the PDO database connection instance.
     *
     * @return PDO The PDO instance.
     */
    public function getConnection(): PDO
    {
        return $this->conn;
    }

    /**
     * Get the single instance of the DatabaseConnection class.
     * Ensures that only one instance of the class exists (Singleton pattern).
     *
     * @return PDO The PDO instance.
     */
    public static function getInstance(): PDO
    {
        if (empty(self::$instance)) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance->getConnection();
    }
}


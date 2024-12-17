<?php

namespace Models;

//require_once dirname(__FILE__).'/Exceptions/DatabaseConnectionFailedException.php';

use AllowDynamicProperties;
use Classes\Exceptions\DatabaseConnectionFailedException;
use mysqli;
use PDO;

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_DATABASE','petcare');

$conn = null;
class DatabaseConnection
{
    private PDO $conn;
    private static DatabaseConnection $instance;

    private function __construct()
    {
        $this->conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DATABASE,DB_USER,DB_PASSWORD);
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }

    public static function getInstance(): PDO
    {
        if(empty(self::$instance)){
            self::$instance = new DatabaseConnection();
        }
        return self::$instance->getConnection();
    }
}


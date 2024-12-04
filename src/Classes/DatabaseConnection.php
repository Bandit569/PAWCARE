<?php

namespace Classes;

require_once dirname(__FILE__).'/Exceptions/DatabaseConnectionFailedException.php';

use AllowDynamicProperties;
use Classes\Exceptions\DatabaseConnectionFailedException;
use mysqli;

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_DATABASE','petcare');

#[AllowDynamicProperties] class DatabaseConnection
{
    /**
     * @throws DatabaseConnectionFailedException
     */
    public function __construct()
    {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        if ($conn->connect_error) {
            throw new DatabaseConnectionFailedException;
        }
        //echo "Database Connected Successfully";
        return $this->conn = $conn;
    }
}


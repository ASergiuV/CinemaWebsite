<?php

namespace Model\Repository;

use PDO;
use PDOException;

class Database
{


    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct()
    {
        require_once "config/Database.php";

        $this->host     = DATABASE_HOST;
        $this->db_name  = DATABASE_NAME;
        $this->username = DATABASE_USERNAME;
        $this->password = DATABASE_PASSWORD;
    }

    public function getConnection()
    {

        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username,
                $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

}

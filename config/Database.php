<?php

namespace config;

use PDOException;

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "balai_latihan_kerja";
    public $connection;

    public function getConnection()
    {
        $this->connection = null;
        try {
        $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->user, $this->pass);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return $this->connection;
    }
}
<?php
class Database
{
    private $host;
    private $user;
    private $pass;
    private $db;
    public $connection;

    /**
     * @param $host
     * @param $user
     * @param $pass
     * @param $db
     */
    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->user = $_ENV['DB_USER'];
        $this->pass = $_ENV['DB_PASS'];
        $this->db = $_ENV['DB_NAME'];
    }


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
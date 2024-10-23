<?php

class LoginAuthModel
{
    private $connection;
    function __construct($db)
    {
        $this->connection = $db;
    }

    public function login($username, $password)
    {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':email', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($password == $user['password']) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
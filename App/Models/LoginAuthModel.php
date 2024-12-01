<?php

class LoginAuthModel
{
    private $connection;
    function __construct($db)
    {
        $this->connection = $db;
    }

    public function loginAdmin($username, $password)
    {
        $query = "SELECT * FROM users WHERE email = :email AND (role = 'admin' OR role = 'super admin') LIMIT 1";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':email', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                unset($user['password']);
                return $user;
            } else {
                http_response_code(401);
                return (['status' => false, 'message' => 'Password salah']);

            }
        } else {
            http_response_code(404);
            return (['status' => false, 'message' => 'Email tidak terdaftar']);
        }
    }

    public function loginUsers($username, $password)
    {
        $query = "SELECT * FROM users WHERE email = :email AND role = :role LIMIT 1";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':email', $username);
        $stmt->bindValue(':role', 'pengguna');
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                unset($user['password']);
                return $user;
            } else {
                http_response_code(401);
                return (['status' => false, 'message' => 'Password salah']);

            }
        } else {
            http_response_code(404);
            return (['status' => false, 'message' => 'Email tidak terdaftar']);
        }
    }
}
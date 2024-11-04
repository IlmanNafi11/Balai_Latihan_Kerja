<?php

use Firebase\JWT\JWT;

class ServiceToken
{
    private $secret;

    public function __construct()
    {
        $this->secret = $_ENV['JWT_SECRET'];
    }

    public function createToken($userid, $email, $role)
    {
        $issuedAt = time();
        $expired = $issuedAt + 3600;

        $payload = [
            'iat' => $issuedAt,
            'exp' => $expired,
            "users" => [
                'id' => $userid,
                'email' => $email,
                'role' => $role
            ]
        ];

        $token = JWT::encode($payload, $this->secret, 'HS256');
        return $token;
    }
}
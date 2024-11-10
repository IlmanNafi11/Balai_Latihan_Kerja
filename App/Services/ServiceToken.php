<?php

use Firebase\JWT\JWT;

class ServiceToken
{
    private $secret;

    public function __construct()
    {
        $this->secret = $_ENV['JWT_SECRET'];
    }

    public function createToken($payload)
    {
        $token = JWT::encode($payload, $this->secret, 'HS256');
        return $token;
    }
}
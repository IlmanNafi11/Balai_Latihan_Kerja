<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function authenticate($token = null)
{
    $secretKey = $_ENV['JWT_SECRET'];
    $headers = getallheaders();
    if ($token != null) {
        try {
            return JWT::decode($token, new Key($secretKey, 'HS256'));
        } catch (Exception $e) {
            http_response_code(401);
            return ['success' => false, 'message' => "Token tidak valid atau kadaluarsa"];
        }

    } else if (isset($headers['Authorization'])) {
        $authHeader = $headers['Authorization'];
        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $jwt = $matches[1];
            try {
                return JWT::decode($jwt, new Key($secretKey, 'HS256'));
            } catch (Exception $e) {
                http_response_code(401);
                return ['success' => false, 'message' => "Token tidak valid atau kadaluarsa"];
            }
        }
    } else {
        http_response_code(400);
        return ['success' => false, 'message' => 'Token tidak ditemukan'];
    }
}


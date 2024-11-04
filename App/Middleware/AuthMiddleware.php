<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function authenticate()
{
    $secretKey = $_ENV['JWT_SECRET'];
    $headers = apache_request_headers();
    $authHeader = $headers['Authorization'];

    if (!$authHeader) {
        http_response_code(401);
        echo json_encode(['status' => 'error', 'message' => 'Token tidak ditemukan']);
        return false;
    }

    if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        $jwt = $matches[1];
        try {
            $decoded = JWT::decode($jwt, new Key($secretKey, 'HS256'));
            $userId = $decoded->users->id;
            return $userId;
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['status' => 'error', 'message' => "Token tidak valid: " . $e->getMessage()]);
            return false;
        }
    }
}


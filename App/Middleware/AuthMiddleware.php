<?php
function authenticate()
{
    $service = new ServiceToken();
    $headers = apache_request_headers();
    $authHeader = $headers['Authorization'];

    if (!$authHeader) {
        echo json_encode(['status' => 'error', 'message' => 'Token tidak ditemukan']);
        http_response_code(401);
        exit;
    }

    $token = str_replace('Bearer ', '', $authHeader);

    $payload = $service->verifyToken($token);

    if (!$payload) {
        echo json_encode(['status' => 'error', 'message' => 'Token tidak valid atau kadaluarsa']);
        http_response_code(401);
        exit;
    }

    return $payload;
}


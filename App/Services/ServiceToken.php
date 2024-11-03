<?php
class ServiceToken
{
    private $secret;

    public function __construct() {
        $this->secret = $_ENV['JWT_SECRET'];
    }

    public function createToken($payload) {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $base64UrlHeader = $this->base64UrlEncode($header);

        // Buat payload
        $payload['iat'] = time();
        $payload['exp'] = time() + (60 * 60);
        $base64UrlPayload = $this->base64UrlEncode(json_encode($payload));

        $signature = hash_hmac('sha256', "$base64UrlHeader.$base64UrlPayload", $this->secret, true);
        $base64UrlSignature = $this->base64UrlEncode($signature);

        return "$base64UrlHeader.$base64UrlPayload.$base64UrlSignature";
    }

    public function verifyToken($jwt) {
        $tokenParts = explode('.', $jwt);
        if (count($tokenParts) !== 3) {
            error_log("format token tidak valid");
            return false;
        }

        list($header, $payload, $signatureProvided) = $tokenParts;

        $signature = hash_hmac('sha256', "$header.$payload", $this->secret, true);
        $base64UrlSignature = $this->base64UrlEncode($signature);

        if ($base64UrlSignature !== $signatureProvided) {
            return false;
        }

        $decodedPayload = json_decode($this->base64UrlDecode($payload), true);
        if ($decodedPayload['exp'] < time()) {
            return false;
        }

        return $decodedPayload;
    }

    private function base64UrlEncode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function base64UrlDecode($data) {
        return base64_decode(strtr($data, '-_', '+/'));
    }
}
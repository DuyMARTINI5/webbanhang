<?php
require_once 'vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTHandler
{
    private $secret_key = "HUTECH_SECRET_KEY_2026";
    private $algorithm = "HS256";

    public function encode($data)
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600; // 1 giờ

        $payload = [
            'iat'  => $issuedAt,
            'exp'  => $expirationTime,
            'data' => $data
        ];

        return JWT::encode($payload, $this->secret_key, $this->algorithm);
    }

    public function decode($jwt)
    {
        try {
            $decoded = JWT::decode($jwt, new Key($this->secret_key, $this->algorithm));
            return (array) $decoded->data;
        } catch (Exception $e) {
            return null;
        }
    }
}
<?php

namespace Ls\ClientAssistant\Helpers;

class Jwt
{
    public static function generate($userId, string $secret = ''): string
    {
        // Create token header as a JSON string
        $header = json_encode(['type' => 'JWT', 'alg' => 'SHA256']);

        // Create token payload as a JSON string
        date_default_timezone_set('Asia/Tehran');
        $time = strtotime(date('Y-m-d H:i:s')) + (60 * 60);
        $payload = json_encode(['id' => $userId, 'exp' => $time]);

        // Encode Header to Base64Url String
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

        // Encode Payload to Base64Url String
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        // Create Signature Hash
        $signature = hash_hmac('SHA256', $base64UrlHeader.".".$base64UrlPayload, $secret, true);

        // Encode Signature to Base64Url String
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        // Create JWT
        return $base64UrlHeader.".".$base64UrlPayload.".".$base64UrlSignature;
    }
}

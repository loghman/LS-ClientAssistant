<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\RequestOptions;
use Ls\ClientAssistant\Core\GuzzleClient;
use Illuminate\Support\Collection;

class TwoFaBasedAuth
{
    public static function login(string $mobileOrEmail): Collection
    {
        $guzzle = GuzzleClient::self();
        $response = $guzzle->post('v1/auth/login', [
            'form_params' => [
                'auth_method' => 'OtpBased',
                'input' => $mobileOrEmail,
            ],
        ]);

        if (in_array($response->getStatusCode(), [200, 201])) {
            return collect(json_decode($response->getBody()));
        }

        return collect();
    }

    public static function verifyVerificationCode(string $mobileOrEmail, string $otp): Collection
    {
        $guzzle = GuzzleClient::self();
        $response = $guzzle->post('v1/auth/verify-otp', [
            'form_params' => [
                'auth_method' => 'OtpBased',
                'input' => $mobileOrEmail,
                'otp' => $otp,
            ],
        ]);

        if (in_array($response->getStatusCode(), [200, 201])) {
            return collect(json_decode($response->getBody()));
        }

        return collect();
    }

    public static function sendVerificationCode($mobileOrEmail): Collection
    {
        $guzzle = GuzzleClient::self();
        $response = $guzzle->post('v1/auth/send-otp', [
            'form_params' => [
                'auth_method' => 'OtpBased',
                'input' => $mobileOrEmail,
            ],
        ]);

        if (in_array($response->getStatusCode(), [200, 201])) {
            return collect(json_decode($response->getBody()));
        }

        return collect();
    }

    public static function logout(string $barerToken): Collection
    {
        $guzzle = GuzzleClient::self();
        $response = $guzzle->get('v1/auth/logout', [
            'headers' => ['Authorization' => 'Bearer ' . $barerToken],
        ]);

        if (in_array($response->getStatusCode(), [200, 201])) {
            return collect(json_decode($response->getBody()));
        }

        return collect();
    }
}
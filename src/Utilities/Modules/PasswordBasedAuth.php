<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\GuzzleClient;

class PasswordBasedAuth
{
    public static function login(string $mobileOrEmail, string $password): Collection
    {
        $guzzle = GuzzleClient::self();
        $response = $guzzle->post('v1/auth/login', [
            'form_params' => [
                'auth_method' => 'PasswordBased',
                'input' => $mobileOrEmail,
                'password' => $password,
            ],
        ]);

        if (in_array($response->getStatusCode(), [200, 201])) {
            return collect(json_decode($response->getBody()));
        }

        return collect();
    }

    public static function register(string $mobileOrEmail, string $password, string $passwordConfirmation): Collection
    {
        $guzzle = GuzzleClient::self();
        $response = $guzzle->post('v1/auth/register', [
            'form_params' => [
                'auth_method' => 'PasswordBased',
                'input' => $mobileOrEmail,
                'password' => $password,
                'password_confirmation' => $passwordConfirmation,
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
                'auth_method' => 'PasswordBased',
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
                'auth_method' => 'PasswordBased',
                'input' => $mobileOrEmail,
            ],
        ]);

        if (in_array($response->getStatusCode(), [200, 201])) {
            return collect(json_decode($response->getBody()));
        }

        return collect();
    }
}
<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Ls\ClientAssistant\Core\GuzzleClient;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Helpers\Response;

class TwoFaBasedAuth
{
    public static function login(string $mobileOrEmail): array
    {
        $guzzle = GuzzleClient::self();
        try {
            $response = $guzzle->post('v1/auth/login', [
                'form_params' => [
                    'auth_method' => 'OtpBased',
                    'input' => $mobileOrEmail,
                ],
            ]);
        } catch (Exception $e) {
            return array_merge(
                json_decode($e->getResponse()->getBody()->getContents(), true),
                ['status' => $e->getCode()]
            );
        }

        return array_merge(
            json_decode($response->getBody()->getContents(), true),
            ['status' => $response->getStatusCode()]
        );
    }

    public static function verifyVerificationCode(string $mobileOrEmail, string $otp): Collection
    {
        try {
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
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function sendVerificationCode($mobileOrEmail): Collection
    {
        try {
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
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function resetPassword($barerToken, $password, $passwordConfirmation): Collection
    {
        try {
            $response = GuzzleClient::self()->post('v1/auth/reset-password', [
                'form_params' => [
                    'password' => $password,
                    'password_confirmation' => $passwordConfirmation
                ],
                'headers' => ['Authorization' => 'Bearer ' . $barerToken],
            ]);

            if (in_array($response->getStatusCode(), [200, 201])) {
                return collect(json_decode($response->getBody()));
            }

            return collect();
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function logout(string $barerToken): Collection
    {
        try {
            $guzzle = GuzzleClient::self();
            $response = $guzzle->get('v1/auth/logout', [
                'headers' => ['Authorization' => 'Bearer ' . $barerToken],
            ]);

            if (in_array($response->getStatusCode(), [200, 201])) {
                return collect(json_decode($response->getBody()));
            }

            return collect();
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
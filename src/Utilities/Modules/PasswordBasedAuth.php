<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Helpers\Response;

class PasswordBasedAuth
{
    public static function login(string $mobileOrEmail, string $password): Collection
    {
        $guzzle = GuzzleClient::self();

        try {
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
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function register(array $data): Collection
    {
        $guzzle = GuzzleClient::self();
        try {
            $response = $guzzle->post('v1/auth/register', [
                'form_params' => $data,
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

    public static function verifyVerificationCode(string $mobileOrEmail, string $otp): Collection
    {
        try {
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
                    'auth_method' => 'PasswordBased',
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

    public static function updateEmail($userToken, $email): Collection
    {
        try {
            $guzzle = GuzzleClient::self();
            $response = $guzzle->post('v1/auth/email-update', [
                'form_params' => [
                    'input' => $email,
                ],
                'headers' => ['Authorization' => 'Bearer ' . $userToken],
            ]);

            if (in_array($response->getStatusCode(), [200, 201])) {
                return collect(json_decode($response->getBody()));
            }

            return collect();
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function updateMobile($userToken, $mobile): Collection
    {
        try {
            $guzzle = GuzzleClient::self();
            $response = $guzzle->post('v1/auth/mobile-update', [
                'form_params' => [
                    'input' => $mobile,
                ],
                'headers' => ['Authorization' => 'Bearer ' . $userToken],
            ]);

            if (in_array($response->getStatusCode(), [200, 201])) {
                return collect(json_decode($response->getBody()));
            }

            return collect();
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
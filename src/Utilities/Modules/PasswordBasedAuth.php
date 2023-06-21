<?php

namespace Ls\ClientAssistant\Utilities\Modules;

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
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function register(string $mobileOrEmail, string $password, string $passwordConfirmation): Collection
    {
        $guzzle = GuzzleClient::self();
        try {
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
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
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
        } catch (\Exception $exception) {
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
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
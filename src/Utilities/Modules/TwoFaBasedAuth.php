<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Ls\ClientAssistant\Core\API;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Helpers\Response;

class TwoFaBasedAuth
{
    public static function login(string $mobileOrEmail): array
    {
        $guzzle = API::self();
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

    public static function verifyVerificationCode(string $mobileOrEmail, string $otp, $passwordResetMode = 0): Collection
    {
        try {
            return API::post('v1/auth/verify-otp', [
                'auth_method' => 'OtpBased',
                'input' => $mobileOrEmail,
                'otp' => $otp,
                'password-reset' => $passwordResetMode,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function sendVerificationCode($mobileOrEmail): Collection
    {
        try {
            return API::post('v1/auth/send-otp', [
                'auth_method' => 'OtpBased',
                'input' => $mobileOrEmail,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function resetPassword($barerToken, $password, $passwordConfirmation): Collection
    {
        try {
            return API::post('v1/auth/reset-password', [
                'password' => $password,
                'password_confirmation' => $passwordConfirmation
            ], [
                'Authorization' => 'Bearer ' . $barerToken
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function logout(string $barerToken): Collection
    {
        try {
            return API::get('v1/auth/logout', [], [
                'Authorization' => 'Bearer ' . $barerToken
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
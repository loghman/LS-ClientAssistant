<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Authentication
{
    public static function login(string $input, string $provider, array $data): Collection
    {
        try {
            return API::post(
                'v1/auth/login', array_merge(['input' => $input, 'auth_method' => $provider], $data)
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function register(string $provider, array $data): Collection
    {
        try {
            return API::post(
                'v1/auth/register', array_merge(['auth_method' => $provider], $data)
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function loginOrRegister(string $input, string $provider, array $data)
    {
        try {
            return API::post(
                'v1/auth/login-or-register', array_merge(['input' => $input, 'auth_method' => $provider], $data)
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function logout(string $userToken)
    {
        try {
            return API::get(
                'v1/auth/logout', [], ['Authorization: Bearer ' . $userToken]
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function verifyRequestResetPassword(string $input, string $otp)
    {
        try {
            return API::post(
                'v1/auth/reset-password/verify', compact('input', 'otp')
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function resetPassword(string $userToken, string $password, string $confirmed)
    {
        try {
            return API::post(
                'v1/auth/reset-password',
                ['password' => $password, 'password_confirmation' => $confirmed],
                ['Authorization: Bearer ' . $userToken]
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function sendVerificationCode(string $input)
    {
        try {
            return API::post(
                'v1/auth/send/verification-code', compact('input')
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function verifyVerificationFields(string $userToken, string $input, string $otp)
    {
        try {
            return API::post(
                'v1/auth/verification-fields/verify',
                compact('input', 'otp'),
                ['Authorization: Bearer ' . $userToken]
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function updateUserMobile(string $userToken, string $mobile)
    {
        try {
            return API::post(
                'v1/auth/mobile/update',
                ['input' => $mobile],
                ['Authorization: Bearer ' . $userToken]
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function updateUserEmail(string $userToken, string $email)
    {
        try {
            return API::post(
                'v1/auth/email/update',
                ['input' => $email],
                ['Authorization: Bearer ' . $userToken]
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;
use Ls\ClientAssistant\Utilities\Tools\Token;

class Authentication
{
    public const authReferer = 'auth_referer';
    public const logoutReferer = 'logout_referer';

    public static function login(string $input, string $provider, array $data): Collection
    {
        try {
            $response = API::post(
                'v1/auth/login', array_merge(['input' => $input, 'auth_method' => $provider], $data)
            );

            if ($response->get('success')) {
                Token::token($response->get('data')['token'])->weeks(4)->save();
                Token::token('', self::authReferer)->remove();
            }

            return $response;
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function preLogin(string $input, array $data)
    {
        try {
            return API::post(
                'v1/auth/pre/login', array_merge(['input' => $input], $data)
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
            $response = API::post(
                'v1/auth/register', array_merge(['auth_method' => $provider], $data)
            );

            if ($response->get('success')) {
                Token::token($response->get('data')['token'])->weeks(4)->save();
            }

            return $response;
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

    public static function logout()
    {
        try {
            $response = API::get('v1/auth/logout');

            if ($response->get('success')) {
                Token::token()->remove();
            }

            return $response;
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function verifyRequestResetPassword(string $input, string $otp, array $data = [])
    {
        try {
            return API::post(
                'v1/auth/reset-password/verify',
                array_merge($data, compact('input', 'otp'))
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function resetPassword(string $userToken, string $password, string $confirmed, array $data = [])
    {
        try {
            return API::post(
                'v1/auth/reset-password',
                array_merge($data, ['password' => $password, 'password_confirmation' => $confirmed]),
                ['Authorization: Bearer ' . $userToken]
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function sendVerificationCode(string $input, array $data = [])
    {
        try {
            return API::post(
                'v1/auth/send/verification-code', array_merge($data, compact('input'))
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function verifyVerificationFields(string $userToken, string $input, string $otp, array $data = [])
    {
        try {
            return API::post(
                'v1/auth/verification-fields/verify',
                array_merge($data, compact('input', 'otp')),
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
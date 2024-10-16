<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class PasswordBasedAuth
{
    public static function login(string $mobileOrEmail, string $password): Collection
    {
        try {
            return API::post('v1/auth/login', [
                'auth_method' => 'PasswordBased',
                'input' => $mobileOrEmail,
                'password' => $password,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function register(array $data): Collection
    {
        try {
            return API::post('v1/auth/register', $data);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function verifyVerificationCode(string $mobileOrEmail, string $otp): Collection
    {
        try {
            return API::post('v1/auth/verify-otp', [
                'auth_method' => 'PasswordBased',
                'input' => $mobileOrEmail,
                'otp' => $otp,
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
                'auth_method' => 'PasswordBased',
                'input' => $mobileOrEmail,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function updateEmail($userToken, $email, array $headers = []): Collection
    {
        try {
            return API::post('v1/auth/email-update', [
                'input' => $email,
            ], $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function updateMobile($userToken, $mobile, array $headers = []): Collection
    {
        try {
            return API::post('v1/auth/mobile-update', ['input' => $mobile,], $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
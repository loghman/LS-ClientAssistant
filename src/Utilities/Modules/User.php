<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Core\Contracts\ModuleUtility;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;
use Ls\ClientAssistant\Helpers\Response;

class User extends ModuleUtility
{
    public static function get(string $idOrSlug, array $with = []): Collection
    {
        try {
            return GuzzleClient::get(('v1/users/' . $idOrSlug), [
                'with' => json_encode($with),
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function list(array $with = [], array $keyValues = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection
    {
        try {
            if (!in_array($orderBy, [OrderByEnum::LATEST, OrderByEnum::FIRST])) {
                throw new \InvalidArgumentException('Order by must be in [first, latest]');
            }

            return GuzzleClient::get('v1/users', [
                'with' => json_encode($with),
                'filter' => json_encode($keyValues),
                'per_page' => $perPage,
                'order_by' => $orderBy,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function search(string $keyword, array $columns = [], array $with = [], int $perPage = 20): Collection
    {
        try {
            return GuzzleClient::get('v1/users', [
                's' => $keyword,
                'with' => json_encode($with),
                'columns' => json_encode($columns),
                'per_page' => $perPage,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function me($userToken): Collection
    {
        try {
            $guzzle = GuzzleClient::self();
            $response = $guzzle->get('v1/user/me', [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $userToken,
                ]
            ]);

            return collect(json_decode($response->getBody()->getContents()));
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function loggedIn(string $userToken): bool
    {
        try {
            $user = self::me($userToken);
            return (!is_null($user['data']) or !empty($user['data']));
        } catch (\Exception $exception) {
            return false;
        }
    }

    public static function updateUserInfo(array $data, string $userToken): Collection
    {
        try {
            $user = self::me($userToken);

            $response = GuzzleClient::put('v1/user', [
                'real_name' => $data['real_name'] ?? $user['data']->real_name,
                'display_name' => $data['display_name'] ?? $user['data']->display_name,
                'gender' => $data['gender'] ?? $user['data']->gender,
                'birth_date' => $data['birth_date'] ?? $user['data']->birth_date,
            ], ['Authorization' => 'Bearer ' . $userToken]);

            if (!$response['success']) {
                return $response;
            }

            return self::me($userToken);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function logout(string $userToken): bool
    {
        try {
            $response = GuzzleClient::get('v1/auth/logout', [], ['Authorization' => 'Bearer ' . $userToken]);

            return $response['success'];
        } catch (\Exception $exception) {
            return false;
        }
    }

    public static function courses(string $userToken): Collection
    {
        try {
            return GuzzleClient::get('v1/user/enrollments', [], [
                'Authorization' => 'Bearer ' . $userToken,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function stats(string $userToken): Collection
    {
        try {
            return GuzzleClient::get('v1/user/stats', [], [
                'Authorization' => 'Bearer ' . $userToken,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function uploadResumeBanner($file, string $userToken, string $title = null, int $attachmentId = null): Collection
    {
        try {
            return GuzzleClient::put('v1/user/resume-banner', [
                'file' => $file,
                'title' => $title,
                'attachment_id' => $attachmentId,
            ], [
                'Authorization' => 'Bearer ' . $userToken,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function updatePassword(string $currentPassword, string $password, string $passwordConfirmation, string $userToken): Collection
    {
        try {
            return GuzzleClient::put('v1/user/update-password', [
                'current_password' => $currentPassword,
                'password' => $password,
                'password_confirmation' => $passwordConfirmation,
            ], [
                'Authorization' => 'Bearer ' . $userToken,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function sendOtpForMobileNumber(string $mobile, string $userToken): Collection
    {
        try {
            return GuzzleClient::put('v1/user/send-otp-for-mobile-number', [
                'input' => $mobile,
            ], [
                'Authorization' => 'Bearer ' . $userToken,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function verifyCodeForUpdatingMobileNumber(string $mobile, string $otp, string $userToken): Collection
    {
        try {
            return GuzzleClient::put('v1/user/verify-mobile-verification-code', [
                'input' => $mobile,
                'otp' => $otp,
            ], [
                'Authorization' => 'Bearer ' . $userToken,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
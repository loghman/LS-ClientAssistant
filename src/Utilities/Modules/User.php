<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Core\Contracts\ModuleUtility;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;

class User extends ModuleUtility
{
    public static function get(string $idOrSlug, array $with = []): Collection
    {
        return GuzzleClient::get(('v1/users/' . $idOrSlug), [
            'with' => json_encode($with),
        ]);
    }

    public static function list(array $with = [], array $keyValues = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection
    {
        if (!in_array($orderBy, [OrderByEnum::LATEST, OrderByEnum::FIRST])) {
            throw new \InvalidArgumentException('Order by must be in [first, latest]');
        }

        return GuzzleClient::get('v1/users', [
            'with' => json_encode($with),
            'filter' => json_encode($keyValues),
            'per_page' => $perPage,
            'order_by' => $orderBy,
        ]);
    }

    public static function search(string $keyword, array $columns = [], array $with = [], int $perPage = 20): Collection
    {
        return GuzzleClient::get('v1/users', [
            's' => $keyword,
            'with' => json_encode($with),
            'columns' => json_encode($columns),
            'per_page' => $perPage,
        ]);
    }

    public static function me($userToken): Collection
    {
        $guzzle = GuzzleClient::self();
        $response = $guzzle->get('v1/user/me', [
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer ' . $userToken,
            ]
        ]);

        return collect(json_decode($response->getBody()->getContents()));
    }

    public static function loggedIn(string $userToken): bool
    {
        $user = self::me($userToken);
        return (!is_null($user['data']) or !empty($user['data']));
    }

    public static function updateUserInfo(array $data, string $userToken): Collection
    {
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
    }

    public static function logout(string $userToken): bool
    {
        $response = GuzzleClient::get('v1/auth/logout', [], ['Authorization' => 'Bearer ' . $userToken]);

        return $response['success'];
    }

    public static function courses(string $userToken): Collection
    {
        return GuzzleClient::get('v1/user/enrollments', [], [
            'Authorization' => 'Bearer ' . $userToken,
        ]);
    }

    public static function stats(string $userToken): Collection
    {
        return GuzzleClient::get('v1/user/stats', [], [
            'Authorization' => 'Bearer ' . $userToken,
        ]);
    }

    public static function uploadResumeBanner($file, string $userToken, string $title = null, int $attachmentId = null): Collection
    {
        return GuzzleClient::put('v1/user/stats', [
            'file' => $file,
            'title' => $title,
            'attachment_id' => $attachmentId,
        ], [
            'Authorization' => 'Bearer ' . $userToken,
        ]);
    }

    public static function updatePassword(string $currentPassword, string $password, string $passwordConfirmation, string $userToken): Collection
    {
        return GuzzleClient::put('v1/user/stats', [
            'current_password' => $currentPassword,
            'password' => $password,
            'password_confirmation' => $passwordConfirmation,
        ], [
            'Authorization' => 'Bearer ' . $userToken,
        ]);
    }
}
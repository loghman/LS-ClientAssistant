<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Core\Contracts\ModuleUtility;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;
use Ls\ClientAssistant\Helpers\Response;
use Ls\ClientAssistant\Utilities\Tools\Token;

class User extends ModuleUtility
{
    private static $currentUser;
    private static $user_cookie_key_name = 'cukey';

    public static function get(string $idOrSlug, array $with = []): Collection
    {
        try {
            return API::get(('v1/users/' . $idOrSlug), [
                'with' => json_encode($with),
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function list(array $with = [], array $keyValues = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection
    {
        try {
            if (!in_array($orderBy, [OrderByEnum::LATEST, OrderByEnum::FIRST])) {
                throw new \InvalidArgumentException('Order by must be in [first, latest]');
            }

            return API::get('v1/users', [
                'with' => json_encode($with),
                'filter' => json_encode($keyValues),
                'per_page' => $perPage,
                'order_by' => $orderBy,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function search(string $keyword, array $columns = [], array $with = [], int $perPage = 20): Collection
    {
        try {
            return API::get('v1/users', [
                's' => $keyword,
                'with' => json_encode($with),
                'columns' => json_encode($columns),
                'per_page' => $perPage,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function me($userToken, array $headers = []): Collection
    {
        try {
            return API::get('v1/user/me', [], $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function setUserKeyCookie($value){
        setcookie(self::$user_cookie_key_name,$value, time() + 1800, '/');
    }

    public static function clearUserKeyCookie(){
        setcookie(self::$user_cookie_key_name,'', time() - 77777, '/');
    }
 
    public static function getCurrent()
    {
        $token = self::getToken();
        if (!$token) {
            return;
        }

        $key = $_COOKIE[self::$user_cookie_key_name] ?? false;
        if($key){
            $user = obc_get($key);
            if($user)
                return $user;
        }

        if (is_null(self::$currentUser)) {
            self::$currentUser = self::me($token);
            if(is_numeric(self::$currentUser['data']['id'] ?? false)){
                $key = md5(self::$currentUser['data']['id'] . 'Moha#madGoft');
                self::setUserKeyCookie($key);
                obc_write($key,self::$currentUser);
            }
        }

        return self::$currentUser;
    }

    public static function forgetCurrent(): void
    {
        self::$currentUser = null;
        Token::token()->remove();
    }

    public static function loggedIn(): bool
    {
        $user = self::getCurrent();
        if (!$user) {
            return false;
        }
        
        return !is_null($user['data']) && !empty($user['data']) && $user['success'];
    }

    public static function mobileVerified(): bool
    {
        return self::getCurrent()['data']['meta']['mobile_verified'] ?? false;
    }

    public static function emailVerified(): bool
    {
        return self::getCurrent()['data']['meta']['email_verified'] ?? false;
    }

    public static function canResetPassword()
    {
        $meta = self::getCurrent()['data']['meta'] ?? [];

        return isset($meta['allow_to_password_reset']) && Carbon::parse($meta['allow_to_password_reset'])
                ->gt(Carbon::now());
    }

    public static function updateUserInfo(array $data, string $userToken, array $headers = []): Collection
    {
        try {
            $user = self::me($userToken);

            $response = API::put('v1/user', [
                'real_name' => $data['real_name'] ?? ($user['data']['real_name'] ?? null),
                'display_name' => $data['display_name'] ?? ($user['data']['display_name'] ?? null),
                'gender' => $data['gender'] ?? ($user['data']['gender'] ?? null),
                'birth_date' => $data['birth_date'] ?? ($user['data']['birth_date'] ?? null),
                'description' => $data['description'] ?? ($user['data']['meta']['description'] ?? ''),
                'username' => $data['username'] ?? ($user['data']['username'] ?? null)
            ], $headers);

            if (!$response['success']) {
                return $response;
            }

            return self::me($userToken);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function logout(string $userToken, array $headers = []): bool
    {
        self::clearUserKeyCookie();
        try {
            $response = API::get('v1/auth/logout', [], $headers);
            self::forgetCurrent();
        } catch (Exception $e) {
            return false;
        }

        return $response['success'] ?? true;
    }

    public static function courses(string $userToken, bool $withUserProgress = false, array $headers = []): Collection
    {
        try {
            return API::get('v1/user/enrollments', [
                'per_page' => 1000,
                'with-user-progress' => $withUserProgress,
            ], $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function stats(string $userToken, array $headers = []): Collection
    {
        try {
            return API::get('v1/user/stats', [], $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function uploadResumeBanner($file, string $userToken, string $title = null, int $attachmentId = null, array $headers = []): Collection
    {
        try {
            return API::put('v1/user/resume-banner', [
                'file' => $file,
                'title' => $title,
                'attachment_id' => $attachmentId,
            ], $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function updatePassword(string $currentPassword, string $password, string $passwordConfirmation, string $userToken, array $headers = []): Collection
    {
        try {
            return API::put('v1/user/update-password', [
                'current_password' => $currentPassword,
                'password' => $password,
                'password_confirmation' => $passwordConfirmation,
            ], $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function uploadProfileImage($file, string $userToken, string $title = null, int $attachmentId = null, array $headers = []): Collection
    {
        try {
            return API::put('v1/user/upload-profile-image', [
                'file' => $file,
                'title' => $title,
                'attachment_id' => $attachmentId,
            ], $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function sendOtpForMobileNumber(string $mobile, string $userToken, array $headers = []): Collection
    {
        try {
            return API::put('v1/user/send-otp-for-mobile-number', [
                'input' => $mobile,
            ], $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function verifyCodeForUpdatingMobileNumber(string $mobile, string $otp, string $userToken, array $headers = []): Collection
    {
        try {
            return API::put('v1/user/verify-mobile-verification-code', [
                'input' => $mobile,
                'otp' => $otp,
            ], $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function rich(array $methods = [], string $userToken = null): Collection
    {
        try {
            return API::get('v1/user/rich', [
                'methods' => $methods,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function getToken(): ?string
    {
        return $_COOKIE['token'] ?? request()->bearerToken() ?? null;
    }

    public static function tokenExists(): ?string
    {
        return $_COOKIE['token'] ?? request()->bearerToken() ?? null;
    }

    public static function resume($id): Collection
    {
        try {
            return API::get('v1/user/resume/' . $id);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
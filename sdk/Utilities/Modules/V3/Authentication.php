<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use GuzzleHttp\Exception\ClientException;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;
use Ls\ClientAssistant\Utilities\Tools\Token;

class Authentication extends Cacher
{
    public static function sendToken(string $uniqueKey, string $authType = 'otp')
    {
        try {
            return API::post(
                'v3/auth/send-token', ['unique_key' => $uniqueKey, 'auth_type' => $authType]
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function auth(array $data, string $authType = 'otp')
    {
        try {
            $response = API::post(
                'v3/auth/auth', array_merge($data, ['auth_type' => $authType])
            );

            if ($response->get('success')) {
                Token::token($response->get('data')['auth']['token'])->weeks(4)->save();
            }

            return $response;
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Hook
{
    public static function get(string $slug): Collection
    {
        try {
            return API::get(sprintf('client/v3/cms/hook/%s', $slug));
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function sendFile(int $id, array $data): Collection
    {
        try {
            return API::post(sprintf('client/v3/cms/hook-download/%s/store', $id), [
                'full_name' => $data['full_name'] ?? null,
                'mobile' => $data['mobile'] ?? null,
                'email' => $data['email'] ?? null,
                'new_user' => $data['new_user'] ?? null,
                'page' => $data['page'],
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
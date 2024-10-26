<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class LMSProductItem extends Cacher
{
    public static function list(ModuleFilter $filter = null): Collection
    {
        try {
            return API::get('client/v3/lms/product-item', $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function get(string $slug, ModuleFilter $filter = null): Collection
    {
        try {
            return API::get('client/v3/lms/product-item/' . $slug, $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function navigate(int $id, ModuleFilter $filter = null): Collection
    {
        try {
            return API::get("client/v3/lms/product-item/{$id}/navigate", $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
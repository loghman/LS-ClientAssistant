<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Exercise extends Cacher
{
    public static function find(int $id, ModuleFilter $filter = null, string $field = null): Collection
    {
        try {
            $path = $field ? "$id/$field" : $id;
            return API::get('client/v3/lms/exercise/'.$path, $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function storeAnswer(ModuleFilter $filter = null): Collection
    {
        try {
            return API::post('client/v3/lms/exercise-answer', $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function listAnswer(ModuleFilter $filter = null): Collection
    {
        try {
            return API::get('client/v3/lms/exercise-answer', $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}

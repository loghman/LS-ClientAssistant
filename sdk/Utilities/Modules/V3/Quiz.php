<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Quiz extends Cacher
{
    public static function find(int $id, ModuleFilter $filter = null, string $field = null): Collection
    {
        try {
            $path = $field ? "$id/$field" : $id;
            return API::get('client/v3/core/quiz/'.$path, $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function storeAnswer(ModuleFilter $filter = null): Collection
    {
        try {
            return API::post('client/v3/core/answer', $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function storeAnswersheet(ModuleFilter $filter = null): Collection
    {
        try {
            return API::post('client/v3/core/answersheet', $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function listAnswer(ModuleFilter $filter = null): Collection
    {
        try {
            return API::get('client/v3/core/answer', $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function signalAnswer(int $answerId, ModuleFilter $filter = null): Collection
    {
        try {
            return API::patch('client/v3/core/answer/'.$answerId, $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function listAnswersheet(ModuleFilter $filter = null): Collection
    {
        try {
            return API::get('client/v3/core/answersheet', $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}

<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Invoice
{
    public static function get(string $hashId, ModuleFilter $filter = null): Collection
    {
        try {
            return API::get(
                'client/v3/salesflow/invoice/' . $hashId,
                $filter ? $filter->all() : []
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class CmsPost extends Cacher
{

    public static function get(string $id, ModuleFilter $filter = null): Collection
    {
        try {
            return API::get('client/v3/cms/post/' . $id, $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    
    public static function list(ModuleFilter $filter = null): Collection
    {
        try {
            return API::get('client/v3/cms/post', $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
    
}

<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class CMS extends Cacher
{
    public static function index(ModuleFilter $filter = null) : Collection
    {
        try {
            return API::get('client/v3/cms/post/', $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
    public static function terminologyList(ModuleFilter $filter = null) : Collection
    {
        try {
            return API::get('client/v3/cms/terminology/', $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function terminologyPostsCount(ModuleFilter $filter = null)  : Collection
    {
        try {
            return API::get('client/v3/cms/terminology/count', $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
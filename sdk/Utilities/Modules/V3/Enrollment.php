<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Enrollment extends Cacher
{
    public static function get(string $id, ModuleFilter $filter = null, string $field = null): Collection
    {
        try {
            $path = $field ? "$id/$field" : $id;
            return API::get('client/v3/lms/enrollment/' . $path, $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function list(ModuleFilter $filter = null): Collection
    {
        try {
            return API::get('client/v3/lms/enrollment', $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function has($user_id,$product_id)
    {
        $filter = ModuleFilter::new()
        ->search('user_id',$user_id ?? -1)->searchJoin('and')
        ->search('entity_type',"lms_products")->searchJoin('and')
        ->search('entity_id',$product_id);
        try {
            $result = API::get('client/v3/lms/enrollment', $filter ? $filter->all() : []);
            return $result['data'][0] ?? false;
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function forUser($user_id)
    {
        $filter = ModuleFilter::new()->search('user_id',$user_id ?? -1);
        try {
            return API::get('client/v3/lms/enrollment', $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function aps(array $parameters): Collection
    {
        try {
            return API::post('client/v3/lms/enrollment/aps', $parameters);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}

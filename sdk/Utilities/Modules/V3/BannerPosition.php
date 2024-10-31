<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class BannerPosition extends Cacher
{
    private static $base = 'client/v3/marketing/promotion-position';

    public static function getBySlug($slug): Collection
    {
        $filter = ModuleFilter::new()->search('slug',$slug)->includes('banners');
        
        try {
            return API::get(self::$base, $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function get(string $id, ModuleFilter $filter = null): Collection
    {
        try {
            return API::get(self::$base.'/' . $id, $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
    
    public static function list(ModuleFilter $filter = null): Collection
    {
        try {
            return API::get(self::$base, $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}

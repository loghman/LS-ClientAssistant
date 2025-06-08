<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use Carbon\Carbon;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;
use Ls\ClientAssistant\Services\FilterBuilderService;

class BannerPositionSliders extends Cacher
{
    private static $base = 'client/v3/marketing/banner-position-slides';

    public static function getBySlug($slug): Collection
    {
        $base_filter = (new FilterBuilderService(self::$base))
            ->includeRelation(['banner_position'])
            ->addComparisonFilter('bannerPosition.slug', '=', $slug)
            ->buildUrl();

        try {
            return API::get($base_filter);
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

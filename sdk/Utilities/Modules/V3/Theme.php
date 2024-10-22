<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Theme extends Cacher
{
    public static function get_current_theme(): Collection
    {
        try {
            $key = __LINE__ . 'current_theme';
            $theme = obc_get($key);
            if(!$theme)
                $theme = obc_write($key,API::get('client/v3/core/theme/active/current'));

            return $theme;
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
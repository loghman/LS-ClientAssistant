<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Campaign
{
    public static function primaryCampaign(): Collection
    {
        try {
            $key = __LINE__ . 'primaryCampaign';
            $primaryCampaign = obc_get($key);
            if(!$primaryCampaign)
                $primaryCampaign = obc_write($key,API::get('v1/primary-campaign'));
            return $primaryCampaign; 
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
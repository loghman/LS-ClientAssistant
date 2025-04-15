<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Media extends Cacher
{
    public static function storeFake(array $data): Collection
    {
        $data = self::sanatizeData($data);
        try {
            return API::post('client/v3/media/media/store-fake', $data);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
    
    public static function store(string $entityType, int $entityId, array $data): Collection
    {
        $data = self::sanatizeData($data);
        try {
            return API::post("client/v3/media/media/store/{$entityType}/{$entityId}", $data);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    private static function sanatizeData(array $data): array
    {
        foreach ($data as &$datum) {
            if ($datum instanceof UploadedFile) {
                $datum = new \CURLFile(
                    $datum->getRealPath(),
                    $datum->getMimeType(),
                    $datum->getClientOriginalName()
                );
            }
        }

        return $data;
    }
}
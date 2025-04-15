<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Utilities\Modules\V3\Media;

class UploadController
{
    public function storeFake(Request $request)
    {
        $response = Media::storeFake($request->all());

        return JsonResponse::json(
            $response->get('message'),
            $response->get('status_code'),
            $response->get('data'),
        );
    }

    public function store(string $entityType, int $entityId, Request $request)
    {
        $response = Media::store($entityType, $entityId, $request->all());

        return JsonResponse::json(
            $response->get('message'),
            $response->get('status_code'),
            $response->get('data'),
        );
    }
}


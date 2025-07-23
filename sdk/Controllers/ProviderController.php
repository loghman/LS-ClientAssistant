<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Transformers\ProductFeedTransformer;
use Ls\ClientAssistant\Utilities\Modules\V3\LMSProduct;
use Ls\ClientAssistant\Utilities\Modules\V3\ModuleFilter;

class ProviderController
{
    public function productFeed(Request $request)
    {
        try {
            $filter = (new ModuleFilter())->includes("category");

            $response = LMSProduct::list($filter);

            if (!$response->get('success', false)) {
                return JsonResponse::unprocessableEntity('خطا در دریافت محصولات', []);
            }
            
            $transformedData = ProductFeedTransformer::collection($response);
            
            return JsonResponse::success('لیست محصولات با موفقیت دریافت شد', $transformedData->toArray());

        } catch (\Exception $e) {
            return JsonResponse::unprocessableEntity('خطا در پردازش درخواست', ['error' => $e->getMessage()]);
        }
    }
} 
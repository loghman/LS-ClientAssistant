<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Transformers\ProductFeedTransformer;
use Ls\ClientAssistant\Utilities\Modules\V3\LMSProduct;
use Ls\ClientAssistant\Utilities\Modules\V3\ModuleFilter;
use Ls\ClientAssistant\Services\ObjectCache;

class ProviderController
{
    public function productFeed(Request $request)
    {
        try {
            $key = 'ProductFeed_' . ($request->page ?? 1);
            
            if (ObjectCache::exists($key)) {
                $transformedData = ObjectCache::get($key);
            } else {
                $filter = (new ModuleFilter())
                    ->includes("category")
                    ->perPage(300)
                    ->page($request->page ?? 1);

                $response = LMSProduct::list($filter);
                
                if (!$response->get('success', false)) {
                    return JsonResponse::unprocessableEntity('خطا در دریافت محصولات', []);
                }
                
                $transformedData = ProductFeedTransformer::collection($response);
                $transformedData = ObjectCache::write($key, $transformedData->toArray());
            }
            
            return JsonResponse::success('لیست محصولات با موفقیت دریافت شد', $transformedData);

        } catch (\Exception $e) {
            return JsonResponse::unprocessableEntity('خطا در پردازش درخواست', ['error' => $e->getMessage()]);
        }
    }
} 